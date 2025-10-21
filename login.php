<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';

    
    $stmt = $pdo->prepare('SELECT * FROM users WHERE nom = ?');
    $stmt->execute([$user]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($pass, $admin['mdp'])) {
        $_SESSION['admin'] = true;
        $_SESSION['username'] = $user;
        header('Location: index.php');
        exit;
    } else {
        header('Location: acceuil.php?err=1');
        exit;
    }
} else {
    header('Location: acceuil.php');
    exit;
}
