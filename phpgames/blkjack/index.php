<!DOCTYPE html>
<html>
<head>
    <title>Blackjack Game</title>
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
    <h1>Blackjack Game</h1>

    <?php
    // Initialize variables
    $deck = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A',
              '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A',
              '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A',
              '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'A'];

    $playerCards = [];
    $dealerCards = [];
    $playerScore = 0;
    $dealerScore = 0;
    $gameOver = false;

    function startGame() {
        // Shuffle the deck
        global $deck;
        shuffle($deck);

        // Deal initial cards
        dealPlayerCard();
        dealPlayerCard();
        dealDealerCard();
        showScore();
    }

    function dealPlayerCard() {
        global $deck, $playerCards, $playerScore;
        $card = array_pop($deck);
        $playerCards[] = $card;
        $playerScore += getCardValue($card);
    }

    function dealDealerCard() {
        global $deck, $dealerCards, $dealerScore;
        $card = array_pop($deck);
        $dealerCards[] = $card;
        $dealerScore += getCardValue($card);
    }

    function showScore() {
        global $playerScore, $dealerScore;
        echo "<p>Player's Score: $playerScore</p>";
        echo "<p>Dealer's Score: $dealerScore</p>";
    }

    function getCardValue($card) {
        if ($card === 'A') {
            return 11;
        } elseif (in_array($card, ['K', 'Q', 'J'])) {
            return 10;
        } else {
            return intval($card);
        }
    }

    function displayCards($cards, $player) {
        echo "<p>$player's Cards: " . implode(' ', $cards) . "</p>";
    }

    function displayMessage($message) {
        echo "<p>$message</p>";
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!$gameOver) {
            if (isset($_POST['deal'])) {
                startGame();
            } elseif (isset($_POST['hit'])) {
                dealPlayerCard();
                displayCards($playerCards, 'Player');

                if ($playerScore > 21) {
                    $gameOver = true;
                    displayMessage("You busted! Dealer wins.");
                }
            } elseif (isset($_POST['stand'])) {
                while ($dealerScore < 17) {
                    dealDealerCard();
                }
                displayCards($dealerCards, 'Dealer');

                if ($dealerScore > 21 || $dealerScore < $playerScore) {
                    displayMessage("You win!");
                } elseif ($dealerScore > $playerScore) {
                    displayMessage("Dealer wins!");
                } else {
                    displayMessage("It's a tie!");
                }

                $gameOver = true;
            }
        }
    }
    ?>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <button type="submit" name="deal">Deal</button>
        <button type="submit" name="hit">Hit</button>
        <button type="submit" name="stand">Stand</button>
    </form>

    <?php
    if ($gameOver) {
        echo "<p>Player's Cards: " . implode(' ', $playerCards) . "</p>";
        echo "<p>Dealer's Cards: " . implode(' ', $dealerCards) . "</p>";
    }
    ?>

    <?php
    if ($gameOver || empty($playerCards)) {
        echo "<p>Click 'Deal' to start a new game.</p>";
    }
    ?>
</body>
</html>
