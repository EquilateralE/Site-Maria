<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Vidéos</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        .home-container {
            max-width: 640px;
            margin: 80px auto 0 auto;
            background: rgba(255,255,255,0.97);
            border-radius: 18px;
            box-shadow: 0 4px 32px rgba(0,0,0,0.09);
            padding: 40px 36px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .big-btn {
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
        .big-btn:hover {
            background: #792ca5;
        }
        .login-form {
            width: 100%;
            max-width: 350px;
            margin: 0 auto;
            background: #f4f4fc;
            border-radius: 12px;
            padding: 22px 16px;
            box-shadow: 0 2px 10px #2221;
        }
        .login-form label {
            font-size: 1em;
            font-weight: bold;
            color: #444;
        }
        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: 100%;
            margin-bottom: 14px;
            padding: 7px 10px;
            border: 1px solid #bbb;
            border-radius: 5px;
        }
        .login-form input[type="submit"] {
            width: 100%;
            padding: 8px;
            background: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        .login-form input[type="submit"]:hover {
            background: #a356e0;
        }
        .title {
            text-align: center;
            font-family: 'Great Vibes', cursive;
            font-size: 2rem;
        }

    </style>
</head>
<body>
    <div class="title">
        <h1>Maria El Ghaoui</h1>
        <h3>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Enim accusamus dignissimos deleniti. 
            Labore consequatur inventore exercitationem nihil assumenda at, 
            fuga delectus minus eveniet recusandae aspernatur qui, porro autem saepe? Officiis?</h3>
    </div>
    <div class="home-container">
        <a href="videos.php" class="big-btn">Accéder aux vidéos</a>

        <form class="login-form" method="post" action="login.php">
            <h3 style="margin-top:0;text-align:center;">Connexion admin</h3>
            <?php if (isset($_GET['err']) && $_GET['err'] == 1): ?>
    <div class="error-msg">
        Identifiant ou mot de passe incorrect.
    </div>
<?php endif; ?>
            <label for="user">Utilisateur :</label>
            <input type="text" name="user" id="user" required>
            <label for="pass">Mot de passe :</label>
            <input type="password" name="pass" id="pass" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>
</body>
</html>
