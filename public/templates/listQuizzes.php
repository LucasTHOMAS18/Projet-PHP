<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Quizz</title>
</head>
<body>
    <h1>Liste des Quizz</h1>
    <a href="index.php?action=create">Créer un nouveau Quiz</a>
    <ul>
        <li><?= htmlspecialchars($data['title']) ?></li>
    </ul>
</body>
</html>
