<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats</title>
</head>
<body>
    <h1>Résultats</h1>
    <p>Votre score est : <?= $_SESSION['score'] ?? 0; ?></p>
    <a href="index.php?action=quiz">Recommencer</a>
</body>
</html>
