<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $file = $_FILES['fichier'] ?? null;

    if ($titre && $description && $file && $file['error'] === 0) {
        // Vérifier l'extension (simple, mp4 seulement ici)
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if ($ext !== 'mp4') {
            $error = "Seuls les fichiers .mp4 sont acceptés.";
        } else {
            $nomFichier = uniqid() . '.mp4';
            move_uploaded_file($file['tmp_name'], 'uploads/' . $nomFichier);

            $stmt = $pdo->prepare("INSERT INTO videos (titre, description, fichier) VALUES (?, ?, ?)");
            $stmt->execute([$titre, $description, $nomFichier]);
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
    <title>Ajouter une vidéo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        <h2>Ajouter une vidéo</h2>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <label>Titre :</label>
        <input type="text" name="titre" required>
        <label>Description :</label>
        <input type="text" name="description" required>
        <label>Vidéo (.mp4) :</label>
        <input type="file" name="fichier" accept="video/mp4" required>
        <input type="submit" value="Ajouter">
        <a href="index.php"><button type="button">Retour</button></a>
    </form>
</body>
</html>
