<!DOCTYPE html>
<html>
<head>
    <title>Number Guessing Game</title>
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
    <h1>Number Guessing Game</h1>

    <?php
    // Initialize variables
    $message = '';
    $randomNumber = rand(1, 10);
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve the user's guess
        $userGuess = $_POST['guess'];

        // Validate the user's guess
        if (!is_numeric($userGuess)) {
            $message = "Please enter a valid number.";
        } elseif ($userGuess < 1 || $userGuess > 10) {
            $message = "Please enter a number between 1 and 10.";
        } elseif ($userGuess < $randomNumber) {
            $message = "Too low. Try again.";
        } elseif ($userGuess > $randomNumber) {
            $message = "Too high. Try again.";
        } else {
            $message = "Congratulations! You guessed the correct number.";
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>Guess a number between 1 and 10:</p>
        <input type="number" name="guess">
        <br>
        <button type="submit">Submit</button>
    </form>

    <p><?php echo $message; ?></p>
</body>
</html>
