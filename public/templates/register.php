<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>
    <form method="POST" action="index.php?action=register">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <button type="submit">S'inscrire</button>
    </form>
    <a href="index.php?action=login">Retour à la connexion</a>
</body>
</html>
