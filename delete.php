<?php
require 'config.php';
$id = $_GET['id'] ?? null;
if ($id) {
    // Récupérer le nom du fichier à supprimer
    $stmt = $pdo->prepare("SELECT fichier FROM videos WHERE id = ?");
    $stmt->execute([$id]);
    $video = $stmt->fetch();
    if ($video && file_exists('uploads/' . $video['fichier'])) {
        unlink('uploads/' . $video['fichier']);
    }
    // Supprimer la base
    $stmt = $pdo->prepare("DELETE FROM videos WHERE id = ?");
    $stmt->execute([$id]);
}
header('Location: index.php');
exit;
