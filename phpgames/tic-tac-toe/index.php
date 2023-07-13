<!DOCTYPE html>
<html>
<head>
    <title>Tic-Tac-Toe Game</title>
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

        table {
            margin: 0 auto;
        }

        td {
            width: 50px;
            height: 50px;
            border: 1px solid #999;
            text-align: center;
            font-size: 24px;
            cursor: pointer;
        }

        .message {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Tic-Tac-Toe Game</h1>

    <?php
    // Initialize the game
    $board = [
        ['', '', ''],
        ['', '', ''],
        ['', '', '']
    ];

    $message = '';
    $gameOver = false;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (isset($_POST['position'])) {
            // Retrieve the position selected by the player
            $position = $_POST['position'];

            // Calculate the row and column based on the position value
            $row = intval($position / 3);
            $column = $position % 3;

            // Check if the selected position is already occupied
            if ($board[$row][$column] === '') {
                // Update the board with the player's move
                $board[$row][$column] = 'X';

                // Check if the player wins
                if (checkWin('X', $board)) {
                    $message = 'You win!';
                    $gameOver = true;
                } else {
                    // Play the computer's move
                    playComputerMove($board);

                    // Check if the computer wins
                    if (checkWin('O', $board)) {
                        $message = 'Computer wins!';
                        $gameOver = true;
                    }
                }
            } else {
                $message = 'Invalid move. Please select an empty position.';
            }
        }
    }

    // Function to check if a player wins
    function checkWin($player, $board) {
        // Check rows
        for ($i = 0; $i < 3; $i++) {
            if ($board[$i][0] === $player && $board[$i][1] === $player && $board[$i][2] === $player) {
                return true;
            }
        }

        // Check columns
        for ($i = 0; $i < 3; $i++) {
            if ($board[0][$i] === $player && $board[1][$i] === $player && $board[2][$i] === $player) {
                return true;
            }
        }

        // Check diagonals
        if (($board[0][0] === $player && $board[1][1] === $player && $board[2][2] === $player) ||
            ($board[0][2] === $player && $board[1][1] === $player && $board[2][0] === $player)) {
            return true;
        }

        return false;
    }

    // Function to make the computer's move
    function playComputerMove(&$board) {
        // Find an empty position on the board
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($board[$i][$j] === '') {
                    // Place the computer's move
                    $board[$i][$j] = 'O';
                    return;
                }
            }
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table>
            <?php for ($i = 0; $i < 3; $i++): ?>
                <tr>
                    <?php for ($j = 0; $j < 3; $j++): ?>
                        <td>
                            <?php if (!$gameOver && $board[$i][$j] === ''): ?>
                                <input type="radio" name="position" value="<?php echo $i * 3 + $j; ?>">
                            <?php endif; ?>
                            <?php echo $board[$i][$j]; ?>
                        </td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
        <?php if (!$gameOver): ?>
            <button type="submit">Make Move</button>
        <?php endif; ?>
    </form>

    <p class="message"><?php echo $message; ?></p>
</body>
</html>
