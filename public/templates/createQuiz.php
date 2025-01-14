<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Quiz</title>
</head>
<body>
    <h1>Créer un Quiz</h1>
    <form method="POST" action="index.php?action=create">
        <label for="title">Titre du Quiz :</label>
        <input type="text" id="title" name="title" required>
        <label for="questions">Questions (format JSON) :</label>
        <textarea id="questions" name="questions" required></textarea>
        <button type="submit">Créer</button>
    </form>
</body>
</html>
