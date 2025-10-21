### Hébergeur de Vidéos — PHP / HTML / CSS

Un site d’hébergement et de partage de vidéos permettant de s’inscrire, de se connecter, d’uploader des vidéos, de les visionner, de les liker, et de gérer ses propres publications. Conçu en PHP natif, HTML5 et CSS3, avec stockage des fichiers sur disque et des métadonnées en base de données.

### Fonctionnalités

Authentification (inscription, connexion, déconnexion)

Upload de vidéos (MP4, WEBM, AVI — formats configurables)

Lecture intégrée via <video>

Likes et statistiques de visionnage

CRUD complet sur les vidéos (créer / modifier / supprimer)

Rôles simples (utilisateur / administrateur)

Gestion des miniatures (générées ou uploadées manuellement)

Section d’accueil et page de gestion administrateur

### Architecture du projet
```
.
├─ image/                 # Ressources d’interface (logos, icônes, miniatures)
├─ uploads/               # Dossier des vidéos uploadées (écriture + lecture)
├─ accueil.php            # Page d’accueil affichant les vidéos récentes
├─ adm.php                # Panneau d’administration (modération, gestion)
├─ config.php             # Connexion à la base de données et constantes
├─ create.php             # Formulaire et traitement d’ajout de vidéo
├─ delete.php             # Suppression d’une vidéo (avec vérifications)
├─ index.php              # Page principale
├─ login.php              # Page de connexion utilisateur
├─ logout.php             # Déconnexion (destruction de session)
├─ style.css              # Styles globaux du site
├─ update.php             # Édition des informations d’une vidéo
└─ videos.php             # Page d’affichage d’une vidéo avec lecteur
```


Note : L’architecture est simple et modulaire. Chaque page PHP gère une action spécifique, sans framework.

### Stack & Prérequis

PHP ≥ 8.1 (extensions : pdo, pdo_mysql, fileinfo)

Serveur web (Apache, Nginx ou php -S)

MySQL/MariaDB pour le stockage des métadonnées des vidéos

Navigateur compatible HTML5 <video>

### Schéma SQL minimal
```
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) UNIQUE NOT NULL,
  email VARCHAR(120) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('user','admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE videos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  title VARCHAR(140) NOT NULL,
  description TEXT,
  file_path VARCHAR(255) NOT NULL,
  thumbnail_path VARCHAR(255) NULL,
  views INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE likes (
  user_id INT NOT NULL,
  video_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (user_id, video_id),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (video_id) REFERENCES videos(id) ON DELETE CASCADE
);
```

### Hébergement local

Le site peut être exécuté en local via XAMPP, WAMP ou PHP intégré.
