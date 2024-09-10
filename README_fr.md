# Mini Blog (application PHP)
***

## Table des matières

1. [Description](#description)
2. [Caractéristiques](#caractéristiques)
3. [Technologies utilisées](#technologies-utilisées)
4. [Installation](#installation)
5. [Démo](#démo)
6. [Licence](#licence)


## Description

Mini Blog est une application PHP simple conçue pour présenter la gestion de base des articles de blog et l'authentification des utilisateurs. Ce projet comprend des fonctionnalités telles que la création, l'affichage, la mise à jour et la suppression de billets de blog, l'enregistrement et la connexion des utilisateurs, ainsi que la gestion des erreurs.


## Caractéristiques

- **Authentification de l'utilisateur** : fonctionnalité sécurisée d'enregistrement et de connexion des utilisateurs.
- **Création d'articles** : un utilisateur connecté peut publier un article.
- **Liste des articles du blog** : affiche la liste des articles sur la page d'accueil, chaque article indiquant l'auteur et la date de création.
- **Affichage d'un article** : les utilisateurs peuvent cliquer sur le titre d'un article pour en afficher le contenu complet.
- **Mise à jour et suppression d'un message** : l'auteur d'un message (et lui seul) peut le mettre à jour ou le supprimer.
- **Gestion des erreurs** : gestion centralisée des erreurs avec journal des erreurs et message d'erreur spécifique pour l'utilisateur.
- **Validation des données** : validation et assainissement des données saisies par l'utilisateur.


## Technologies utilisées

- PHP (avec PDO pour l'interaction avec la base de données)
- MySQL
- phpMyAdmin
- Bootstrap 5.3 pour la conception et la mise en page.
- HTML/CSS pour la structure et le style.
- JavaScript pour les interactions dynamiques de base (validation de mot de passe, alertes modales).


## Installation

### Prérequis

- PHP 8.2 ou supérieur
- MySQL/MariaDB 10.4 ou supérieur
- Un serveur web compatible avec PHP (Apache, par exemple)

### Etapes de l'installation

1. **Télécharger le code source**

   Clonez ce dépôt ou téléchargez le code source.

2. **Créer la base de données**

   Exécutez le fichier `mini_blog.sql` pour créer la base de données et les tables nécessaires. Utilisez la commande suivante dans votre terminal :
   ```
   mysql -u [nom d'utilisateur] -p < mini_blog.sql
   ```
   (Remplacez [nom d'utilisateur] par votre nom d'utilisateur MySQL/MariaDB. Vous serez invité à saisir votre mot de passe).

3. **Configurer la connexion à la base de données**

    Créez un fichier de configuration pour définir les paramètres de connexion à la base de données. 

    Par exemple, vous pouvez créer config/database.php avec le contenu suivant :
    ```
    <?php

    return [
        'db_host' => 'localhost',
        'db_port' => 3306,
        'db_name' => 'mini_blog',
        'db_user' => 'root',
        'db_password' => '',
    ] ;
    ```

4. **Configurer le serveur web**

    Assurez-vous que votre serveur web pointe vers le répertoire où se trouvent les fichiers de l'application PHP.

5. **Vérifier l'installation**

    Ouvrez un navigateur web et naviguez jusqu'à l'URL où l'application est hébergée pour vérifier que tout fonctionne correctement.


## Démo

Le fichier mini_blog.sql comprend un exemple d'auteur et quelques exemples d'articles de blog, pour vous aider à tester l'application sans avoir besoin de créer un compte utilisateur ou des billets :

    Auteur :
        Courriel : fictive-author@example.com
        Nom d'utilisateur : FictiveAuthor
        Mot de passe : Password#1

    Exemples d'articles de blog :
        "Bienvenue dans Mini Blog !"
        "Exemple de texte long"


## Licence

Ce projet est placé sous la licence MIT. Voir le fichier LICENSE pour plus de détails.
