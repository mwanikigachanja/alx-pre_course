<!DOCTYPE html>
<html>
<head>
    <title>Hangman Game</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        h1 {
            color: #333;
        }

        p {
            color: #666;
        }

        input {
            padding: 5px;
            margin-top: 10px;
        }

        button {
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Hangman Game</h1>

    <?php
    $words = [
        'hangman',
        'javascript',
        'programming',
        'web',
        'php',
        'html',
        'css',
        'code',
        'computer',
        'software'
    ];

    $randomWord = $words[array_rand($words)];
    $wordLength = strlen($randomWord);
    $wordArray = str_split($randomWord);
    $displayWord = array_fill(0, $wordLength, '_');
    $remainingAttempts = 6;
    $message = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['guess'])) {
            $guessedLetter = strtolower($_POST['guess']);
            $found = false;

            for ($i = 0; $i < $wordLength; $i++) {
                if ($guessedLetter === $wordArray[$i]) {
                    $displayWord[$i] = $guessedLetter;
                    $found = true;
                }
            }

            if (!$found) {
                $remainingAttempts--;

                if ($remainingAttempts === 0) {
                    $message = "Game over! The word was '$randomWord'.";
                }
            }

            if (implode('', $displayWord) === $randomWord) {
                $message = "Congratulations! You guessed the word '$randomWord'.";
            }
        }
    }
    ?>

    <p>Guess the word:</p>
    <p><?php echo implode(' ', $displayWord); ?></p>
    <p>Remaining attempts: <?php echo $remainingAttempts; ?></p>

    <?php if ($remainingAttempts > 0 && $message === ''): ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="guess" maxlength="1">
            <br>
            <button type="submit">Guess</button>
        </form>
    <?php endif; ?>

    <p><?php echo $message; ?></p>
</body>
</html>
