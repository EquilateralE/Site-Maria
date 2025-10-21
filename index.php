<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header('Location: index.php');
    exit;
}

require 'config.php';
$stmt = $pdo->query('SELECT * FROM videos ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>CRUD Vidéos - Liste</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    <style>
        .upper-title {
            margin: 80px auto 0 auto;
            max-width: 550px;
        }
        .add-btn {
            display: block;
            padding: 22px 48px;
            font-size: 1.5em;
            background: #a356e0;
            color: #fff;
            border: none;
            border-radius: 16px;
            margin-bottom: 32px;
            font-weight: bold;
            text-decoration: none;
            transition: background 0.2s;
            box-shadow: 0 2px 12px #a356e022;
        }
        .add-btn:hover {
            background: #792ca5;
        }
    </style>
</head>
<body>
    <div class="upper-title">
        <h2 style="text-align:center;">Liste des vidéos</h2>
        <p style="text-align:center;"><a class="add-btn" href="create.php">Ajouter une vidéo</a></p>
    </div>
    <div class="videos-list">
<?php while ($row = $stmt->fetch()): ?>
    <div class="video-card">
        <h3 class="video-title"><?= htmlspecialchars($row['titre']) ?></h3>
        <div class="video-container">
            <video
                class="video-js vjs-default-skin"
                controls
                preload="auto"
                width="100%"
                height="auto"
                data-setup='{}'
                style="display:block;"
            >
                <source src="uploads/<?= htmlspecialchars($row['fichier']) ?>" type="video/mp4" />
                Votre navigateur ne supporte pas la vidéo.
            </video>
        </div>
        <div class="actions">
            <a href="update.php?id=<?= $row['id'] ?>">Modifier</a>
            <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Supprimer cette vidéo ?');">Supprimer</a>
        </div>
    </div>
<?php endwhile; ?>
</div>


</body>
</html>
