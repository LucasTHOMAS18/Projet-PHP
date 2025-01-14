<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importer un Quiz</title>
</head>
<body>
    <h1>Importer un Quiz</h1>
    <form method="POST" enctype="multipart/form-data" action="index.php?action=import">
        <label for="quizFile">Fichier JSON :</label>
        <input type="file" id="quizFile" name="quizFile" accept="application/json" required>
        <button type="submit">Importer</button>
    </form>
    <a href="index.php?action=quiz">Retour au quiz</a>
</body>
</html>
