<!DOCTYPE html>
<html>
<head>
    <title>Rock Paper Scissors Game</title>
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
    <h1>Rock Paper Scissors Game</h1>

    <?php
    // Initialize variables
    $choices = array('rock', 'paper', 'scissors');
    $playerChoice = '';
    $computerChoice = '';
    $message = '';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve the player's choice
        $playerChoice = $_POST['choice'];

        // Generate the computer's choice
        $computerChoice = $choices[rand(0, 2)];

        // Determine the winner
        if ($playerChoice === $computerChoice) {
            $message = "It's a tie!";
        } elseif (
            ($playerChoice === 'rock' && $computerChoice === 'scissors') ||
            ($playerChoice === 'paper' && $computerChoice === 'rock') ||
            ($playerChoice === 'scissors' && $computerChoice === 'paper')
        ) {
            $message = "You win!";
        } else {
            $message = "Computer wins!";
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <p>Select your choice:</p>
        <input type="radio" name="choice" value="rock" id="rock">
        <label for="rock">Rock</label>
        <br>
        <input type="radio" name="choice" value="paper" id="paper">
        <label for="paper">Paper</label>
        <br>
        <input type="radio" name="choice" value="scissors" id="scissors">
        <label for="scissors">Scissors</label>
        <br>
        <button type="submit">Submit</button>
    </form>

    <p><?php echo $message; ?></p>
    <p>Your choice: <?php echo $playerChoice; ?></p>
    <p>Computer's choice: <?php echo $computerChoice; ?></p>
</body>
</html>
