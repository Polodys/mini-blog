<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Accueil - Liste des articles</h1>
    <ul>
        <?php foreach ($posts as $post): ?>
            <li>
            <a href=""><?= htmlspecialchars($post->getTitle()) ?></a>
            </li>
        <?php endforeach ?>
    </ul>
</body>
</html>