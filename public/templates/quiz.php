<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username'])) {
    $_SESSION['username'] = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
    <h1>Bienvenue sur le Quiz</h1>
    <form method="POST" action="">
        <a href="index.php?action=export">Télécharger le Quiz</a>
        <label for="username">Entrez votre nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Commencer</button>
    </form>

    <form method="POST" action="">
        <label for="nbQuestions">Nombre de questions :</label>
        <input type="number" id="nbQuestions" name="nbQuestions" 
            min="1" 
            max="<?= $_SESSION['maxQuestions'] ?>" 
            value="<?= $_SESSION['nbQuestions'] ?? $_SESSION['maxQuestions'] ?>">
        <button type="submit">Appliquer</button>
    </form>

    <h1><?= $quiz->getTitle() ?></h1>
    <p>Bienvenue, <strong><?= htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') ?></strong> !</p>
    <form method="POST" action="index.php?action=check">
        <?php foreach ($quiz->getQuestions() as $index => $question): ?>
            <fieldset>
                <legend><?= $question->getText() ?></legend>
                <?php foreach ($question->getChoices() as $choice): ?>
                    <label>
                        <input type="radio" name="answers[<?= $index ?>]" value="<?= $choice ?>"> <?= $choice ?>
                    </label>
                <?php endforeach; ?>
            </fieldset>
        <?php endforeach; ?>
        <button type="submit">Valider</button>
    </form>
</body>
</html>