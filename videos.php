<?php
require 'config.php';
$stmt = $pdo->query('SELECT * FROM videos ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vidéos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 style="text-align:center;">Galerie de vidéos</h2>
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
                    >
                        <source src="uploads/<?= htmlspecialchars($row['fichier']) ?>" type="video/mp4" />
                    </video>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
