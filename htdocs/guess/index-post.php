<!-- index-get.php -->

<?php

require "config.php";
require "autoload.php";

// $exception = True;
$guessedNumber = null;
$class = "post";
$method = "post";

?>

<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <title>Guess my number</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <main class= <?= $method ?>>

        <title>Guess my number - <?= strtoupper($method) ?> </title>

        <h1 class="h1-<?= $class ?>">A guessing game with <?= strtoupper($method) ?> </h1>

        <navbar class=navbar>
            <a href="index.php">Return to start page</a>
            <a href="index-<?= $class ?>.php">Reset game</a>
        </navbar>

<?php

$done = "false";

if (!isset($_POST['theNumber'])) {
    // echo("Before the first guess, default parameters 'injected' in the object.<br/>");
    $guess = new Guess();

    // Creating a random number:
    $guess->createTheNumber();
} else {
    $guess = new Guess($_POST['theNumber'], $_POST['noGuessesLeft']);
} ?>


<div class="thenumber <?= isset($_POST['cheat']) ? " visible" : " hidden" ?>"> <?=
    "<p>theNumber is: " . $guess->getTheNumber() . "</p>"; ?>
</div>


<!-- För att resultat-diven ska visas även innan några gissningar gjorts:  -->
<?php if (!isset($_POST['guessedNumber'])) { ?>
    <div class="result">
        <?= "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
        "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() ?>
    </div>
<?php   } ?>

<?php

// echo "\$_POST['guessedNumber'] = ";
// echo $_POST['guessedNumber'];


try {
    if (isset($_POST["cheat"])) {
        // echo "<div class='result'><h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() . "</div>";
        echo "<div class='result'><h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4></div>";
        // For each guess
    } else if (isset($_POST['guessedNumber']) && !$guess->checkIfOutOfBounds(htmlentities($_POST['guessedNumber']))) {
        $result = $guess->checkTheGuess(htmlentities($_POST['guessedNumber']));

        if ($_POST['guessedNumber'] === $guess->getTheNumber()) {
            $done = "true";
            // echo "The number is correct!";
        }

        if ($guess->getNoGuessesLeft() >= 0) {
            // if (isset($_POST['guessedNumber'])) {
            if (isset($_POST['guessedNumber'])) {
                // echo "<br/>The guessedNumber is: " . $guessedNumber;

                if (!$guess->checkIfOutOfBounds(htmlentities($_POST['guessedNumber']))) {
                    $result = $guess->checkTheGuess(htmlentities($_POST['guessedNumber']));
                }

                // To set class on h3-elements depending on the result of the guess
                $words=[];
                $words = explode(' ', $result);
                $lastWord = array_pop($words);
                $lastWord = substr($lastWord, 0, -1);
                ?>

                <!-- Måste använda $_POST['guessedNumber'] här. Om $guess->guessedNumber sparas/skrivs inte det gissade numret ut. -->

                <div class="result">
                <?= "<h4>The guessed number </h4>" . "<h3 class='$lastWord'>" . htmlentities($_POST['guessedNumber']) . "</h3>" . "<h4>  is  </h4>" . "<h3  class='$lastWord'>" . $result . "</h3>"
                . "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() ?>
                </div>

                <?php
            }
        } else {
            // $exception = False;
            ?>
            <div class="result">
                <?= "<h3>Sorry, you have no guesses left!</h3>" .
                "<h3>The correct number was " . $guess->getTheNumber() . ". </h3>" ?> <?php ?>
            </div> <?php
        }
    }?> <?php
} catch (Exception $e) { ?>
    <div class="result">
        <?= "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" .
        // "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft()
        "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>"; ?>
    </div> <?php

    // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
}


?>

<!-- Formuläret måste ligga EFTER try/catch-satsen annars räknas noGuessesLeft ner även vid ett exception. -->

<div class="form-wrap ">

<!-- Formulär för att gissa ett nummer -->
<form class='form1' action="" method= <?= $method ?>>
    <!-- <input type="number" name="guessedNumber" value= <?= $guessedNumber ?>> -->
    <!-- <input type="number" name="guessedNumber" value='<?= $guessedNumber ?>' <?= (isset($_POST["guessedNumber"]) && ($guess->checkTheGuess($_POST["guessedNumber"]) === "correct!")) ? "disabled" : "" ?>> -->
    <input type="number" name="guessedNumber" value='<?= $guessedNumber ?>' <?= $done === "true" ? "disabled" : "" ?>>
    <input type="hidden" name="theNumber" value= <?= $guess->getTheNumber() ?>>
    <input type="hidden" name="done" value='<?= $done ?>'>
    <input type="hidden" name="noGuessesLeft" value= <?= ($guess->getNoGuessesLeft())-1 ?>>
    <!-- <input class="submit" type="submit" value="Submit guess"> -->
    <input class="submit" type="submit" value="Submit guess" <?= $done === "true" ? "disabled" : "" ?> >
</form>

<form class='form2' action="" method= <?= $method ?>>
    <input type="hidden" name="guessedNumber" value=null>
    <input type="hidden" name="theNumber" value= <?= $guess->getTheNumber() ?>>
    <input type="hidden" name="done" value='<?= $done ?>'>
    <!-- <input type="hidden" name="noGuessesLeft" value= <?= ($guess->getNoGuessesLeft())-1  ?>>        Om inte något värde på "noGuessesLeft" skickas med så blir alltid detta värde 6 efter att 'cheat' körts  -->
    <input type="hidden" name="noGuessesLeft" value= <?= ($guess->getNoGuessesLeft())  ?>>
    <!-- <input class="submit" type="submit" name="cheat" value="Cheat"> -->
    <input class="submit" type="submit" name="cheat" value="Cheat" <?= $done === "true" ? "disabled" : "" ?>>
</form>

</div>

<?php

// isset-satserna måste ligga EFTER formuläret annars nollställs inte inmatningsrutan mellan två gissningar

$theNumber = isset($_POST['theNumber'])
    ? htmlentities($_POST['theNumber'])
    : null;
// echo "<br/>theNumber after the form: " . $theNumber;

$guessedNumber = isset($_POST['guessedNumber'])
    ? htmlentities($_POST['guessedNumber'])
    : null;

$noGuessesLeft = isset($_POST['noGuessesLeft'])
    ? htmlentities($_POST['noGuessesLeft'])
    : null;

?>

    </main>

</body>
