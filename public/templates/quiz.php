<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
    <h1><?= $quiz->getTitle() ?></h1>
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
