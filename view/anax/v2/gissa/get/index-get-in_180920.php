<?php

namespace Anna\Guess;

require __DIR__ . "/../config.php";
require __DIR__ . "/../../../../../vendor/autoload.php";

// $exception = True;

$guessedNumber = null;
$class = "get";
$method = "get";

echo "\$mount = " . $mount;

?>

<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <title>Guess my number</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../view/anax/v2/gissa/css/style_guess.css">
</head>

<body class="<?= $data['class'] ?>">

    <main class= <?= $method ?>>

        <title>Guess my number - <?= strtoupper($method) ?> </title>

            <h1 class="h1-<?= $class ?>">A guessing game with <?= strtoupper($method) ?> </h1>

            <navbar class=navbar>
                <!-- <a href="index.php">Return to start page</a>
                <a href="index-<?= $class ?>.php">Reset game</a> -->
                <!-- <a href="../gissa">Return to start page</a> -->
                <a href="<?= url($mount) ?>">Return to start page</a>
                <a href="index-<?= $class ?>.php">Reset game</a>
                <!-- href="<?= url($mount."di") ?>" -->
            </navbar>

<?php

$done = "false";

if (!isset($_GET['theNumber'])) {
    // echo("Before the first guess, default parameters 'injected' in the object.<br/>");
    $guess = new Guess();

    // Creating a random number:
    $guess->createTheNumber();
} else {
    $guess = new Guess($_GET['theNumber'], $_GET['noGuessesLeft']);
} ?>


<div class="thenumber <?= isset($_GET['cheat']) ? " visible" : " hidden" ?>"> <?=
    "<p>theNumber is: " . $guess->getTheNumber() . "</p>"; ?>
</div>


<!-- För att resultat-diven ska visas även innan några gissningar gjorts:  -->
<?php if (!isset($_GET['guessedNumber'])) { ?>
    <div class="result" id="result">
        <?= "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
        "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() ?>
    </div>
<?php   } ?>

<?php

// echo "\$_GET['guessedNumber'] = ";
// echo $_GET['guessedNumber'];


try {
    if (isset($_GET["cheat"])) {
        // echo "<div class='result'><h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() . "</div>";
        echo "<div class='result' id='result'><h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4></div>";
        // For each guess
    } else if (isset($_GET['guessedNumber']) && !$guess->checkIfOutOfBounds(htmlentities($_GET['guessedNumber']))) {
        $result = $guess->checkTheGuess(htmlentities($_GET['guessedNumber']));

        if ($_GET['guessedNumber'] === $guess->getTheNumber()) {
            $done = "true";
            // echo "The number is correct!";
        }

        if ($guess->getNoGuessesLeft() >= 0) {
            // if (isset($_GET['guessedNumber'])) {
            if (isset($_GET['guessedNumber'])) {
                // echo "<br/>The guessedNumber is: " . $guessedNumber;

                if (!$guess->checkIfOutOfBounds(htmlentities($_GET['guessedNumber']))) {
                    $result = $guess->checkTheGuess(htmlentities($_GET['guessedNumber']));
                }

                // To set class on h3-elements depending on the result of the guess
                $words=[];
                $words = explode(' ', $result);
                $lastWord = array_pop($words);
                $lastWord = substr($lastWord, 0, -1);
                ?>

                <!-- Måste använda $_GET['guessedNumber'] här. Om $guess->guessedNumber sparas/skrivs inte det gissade numret ut. -->

                <div class="result" id="result">
                <?= "<h4>The guessed number </h4>" . "<h3 class='$lastWord'>" . htmlentities($_GET['guessedNumber']) . "</h3>" . "<h4>  is  </h4>" . "<h3  class='$lastWord'>" . $result . "</h3>"
                . "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() ?>
                </div>

                <?php
            }
        } else {
            // $exception = False;
            ?>
            <div class="result" id="result">
                <?= "<h3>Sorry, you have no guesses left!</h3>" .
                "<h3>The correct number was " . $guess->getTheNumber() . ". </h3>" ?> <?php ?>
            </div> <?php
        }
    }?> <?php
} catch (\Exception $e) { ?>
    <div class="result" id="result">
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
<form class='form1' action="#result" method= <?= $method ?>>
    <!-- <input type="number" name="guessedNumber" value= <?= $guessedNumber ?>> -->
    <!-- <input type="number" name="guessedNumber" value='<?= $guessedNumber ?>' <?= (isset($_GET["guessedNumber"]) && ($guess->checkTheGuess($_GET["guessedNumber"]) === "correct!")) ? "disabled" : "" ?>> -->
    <input type="number" name="guessedNumber" value='<?= $guessedNumber ?>' <?= $done === "true" ? "disabled" : "" ?>>
    <input type="hidden" name="theNumber" value= <?= $guess->getTheNumber() ?>>
    <input type="hidden" name="done" value='<?= $done ?>'>
    <input type="hidden" name="noGuessesLeft" value= <?= ($guess->getNoGuessesLeft())-1 ?>>
    <!-- <input class="submit" type="submit" value="Submit guess"> -->
    <input class="submit" type="submit" value="Submit guess" <?= $done === "true" ? "disabled" : "" ?> >
</form>

<form class='form2' action="#result" method= <?= $method ?>>
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

$theNumber = isset($_GET['theNumber'])
    ? htmlentities($_GET['theNumber'])
    : null;
// echo "<br/>theNumber after the form: " . $theNumber;

$guessedNumber = isset($_GET['guessedNumber'])
    ? htmlentities($_GET['guessedNumber'])
    : null;

$noGuessesLeft = isset($_GET['noGuessesLeft'])
    ? htmlentities($_GET['noGuessesLeft'])
    : null;

?>

    </main>

</body>
