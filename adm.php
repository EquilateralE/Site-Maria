<?php
require 'config.php';
$username = 'Maria'; // à changer
$password = '1234'; // à changer
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO users (nom, mdp) VALUES (?, ?)');
$stmt->execute([$username, $hash]);
echo "Admin créé !";
