<?php
require 'config.php';
$id = $_GET['id'] ?? null;
if (!$id) header('Location: index.php');

$stmt = $pdo->prepare("SELECT * FROM videos WHERE id = ?");
$stmt->execute([$id]);
$video = $stmt->fetch();

if (!$video) header('Location: index.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $file = $_FILES['fichier'] ?? null;
    $nomFichier = $video['fichier']; // Par défaut, l'ancien fichier

    if ($titre && $description) {
        // Si une nouvelle vidéo est uploadée
        if ($file && $file['error'] === 0) {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if ($ext !== 'mp4') {
                $error = "Seuls les fichiers .mp4 sont acceptés.";
            } else {
                // Supprimer l'ancien fichier
                if (file_exists('uploads/' . $nomFichier)) unlink('uploads/' . $nomFichier);

                $nomFichier = uniqid() . '.mp4';
                move_uploaded_file($file['tmp_name'], 'uploads/' . $nomFichier);
            }
        }
        if (empty($error)) {
            $stmt = $pdo->prepare("UPDATE videos SET titre = ?, description = ?, fichier = ? WHERE id = ?");
            $stmt->execute([$titre, $description, $nomFichier, $id]);
            header('Location: index.php');
            exit;
        }
    } else {
        $error = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une vidéo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Modifier une vidéo</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <label>Titre :</label>
        <input type="text" name="titre" value="<?= htmlspecialchars($video['titre']) ?>" required>
        <label>Description :</label>
        <input type="text" name="description" value="<?= htmlspecialchars($video['description']) ?>" required>
        <p>Vidéo actuelle :</p>
        <video width="200" controls>
            <source src="uploads/<?= htmlspecialchars($video['fichier']) ?>" type="video/mp4">
        </video>
        <label>Remplacer la vidéo (optionnel, .mp4) :</label>
        <input type="file" name="fichier" accept="video/mp4">
        <input type="submit" value="Modifier">
        <a href="index.php"><button type="button">Retour</button></a>
    </form>
</body>
</html>
