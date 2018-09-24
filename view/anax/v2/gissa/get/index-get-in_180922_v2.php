<?php

// namespace Anna\Guess;

namespace Anax\View;

/****************
* Get vyn:s template fil
*
*/

// require __DIR__ . "/../config.php";
// require __DIR__ . "/../../../../../vendor/autoload.php";
//
// // $exception = True;
//
// $guessedNumber = null;
// $class = "get";
// $data["method"] = "get";


// // Detta stycke har flyttats upp och flyttats över till routern
//
// $done = "false";
//
// if (!isset($_GET['theNumber'])) {
//     // echo("Before the first guess, default parameters 'injected' in the object.<br/>");
//     $guess = new Guess();
//
//     // Creating a random number:
//     $guess->createTheNumber();
// } else {
//     $guess = new Guess($_GET['theNumber'], $_GET['noGuessesLeft']);
// }

// $data["method"] = "get";
$result = "";

?>


<!-- Nedanstående måste ligga kvar i vyn så länge -->


<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <title>Guess my number</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../view/anax/v2/gissa/css/style_guess.css">
</head>

<body class="<?= $data['class'] ?>">

    <main class= <?= $data["method"] ?>>

        <title>Guess my number - <?= strtoupper($data["method"]) ?> </title>

            <h1 class="h1-<?= $class2 ?>">A guessing game with <?= strtoupper($data["method"]) ?> </h1>

            <navbar class=navbar>
                <a href="<?= url($mount) ?>">Return to start page</a>
                <a href="<?= url($mount."/".$class2) ?>">Reset game</a>
            </navbar>


<?= "\$mount = " . $mount ?>;

<div class="thenumber <?= isset($_GET['cheat']) ? " visible" : " hidden" ?>"> <?=
    "<p>theNumber is: " . $guess->getTheNumber() . "</p>"; ?>
</div>


<!-- För att resultat-diven ska visas även innan några gissningar gjorts:  -->
<?php if (!isset($_GET['guessedNumber'])) {
    $result = "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
        "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft();
} ?>

<?php


// \Anna\Guess\Result::getAndDisplayResultBeforeGuessHasBeenMade($_GET['guessedNumber'], $guess->getNoGuessesLeft());
// echo "\$_GET['guessedNumber'] = ";
// echo $_GET['guessedNumber'];


// Försök till att bryta upp detta långa nästlade try/catch-block för att tydliggöra var någonstans exception kastas:

if (isset($_GET["cheat"])) {
    // echo "<div class='result'><h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() . "</div>";
    // echo "<div class='result' id='result'><h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4></div>";
    $result = "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
    // // For each guess
} else if (isset($_GET['guessedNumber'])) {
    try {
        $guess->checkIfOutOfBounds(htmlentities($_GET['guessedNumber']));
        $comparison = $guess->checkTheGuess(htmlentities($_GET['guessedNumber']));
        $lastWord = \Anna\Guess\Result::setClassOnH3($comparison);
        if ($_GET['guessedNumber'] === $guess->getTheNumber()) {
            $done = "true";
            // echo "The number is correct!";
        }
        if ($guess->getNoGuessesLeft() >= 0) {
            // if (isset($_GET['guessedNumber'])) {
            // if (isset($_GET['guessedNumber'])) {
                // echo "<br/>The guessedNumber is: " . $guessedNumber;

                // if (!$guess->checkIfOutOfBounds(htmlentities($_GET['guessedNumber']))) {
                //     $comparison = $guess->checkTheGuess(htmlentities($_GET['guessedNumber']));
                // }

                // $lastWord = \Anna\Guess\Result::setClassOnH3($comparison);
                ?>

                   <!-- Måste använda $_GET['guessedNumber'] här. Om $guess->guessedNumber sparas/skrivs inte det gissade numret ut. -->

                 <?php

                $result =  "<h4>The guessed number </h4>" . "<h3 class='$lastWord'>" . htmlentities($_GET['guessedNumber']) . "</h3>" . "<h4>  is  </h4>" . "<h3  class='$lastWord'>" . $comparison . "</h3>"
                . "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft();
            // }
        } else {
            // $exception = False;
               ?>
               <?php

            $result = "<h3>Sorry, you have no guesses left!</h3>" .
                "<h3>The correct number was " . $guess->getTheNumber() . ". </h3>";
        }
    } catch (\Exception $e) {
        $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
        // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
    }
// } !$guess->checkIfOutOfBounds(htmlentities($_GET['guessedNumber'])
}

// try {
//     if (isset($_GET["cheat"])) {
//         // echo "<div class='result'><h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() . "</div>";
//         // echo "<div class='result' id='result'><h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4></div>";
//         $result = "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
//         // // For each guess
//     } else if (isset($_GET['guessedNumber']) && !$guess->checkIfOutOfBounds(htmlentities($_GET['guessedNumber']))) {
//         $comparison = $guess->checkTheGuess(htmlentities($_GET['guessedNumber']));
//
//         if ($_GET['guessedNumber'] === $guess->getTheNumber()) {
//             $done = "true";
//             // echo "The number is correct!";
//         }
//
//         if ($guess->getNoGuessesLeft() >= 0) {
//             // if (isset($_GET['guessedNumber'])) {
//             if (isset($_GET['guessedNumber'])) {
//                 // echo "<br/>The guessedNumber is: " . $guessedNumber;
//
//                 if (!$guess->checkIfOutOfBounds(htmlentities($_GET['guessedNumber']))) {
//                     $comparison = $guess->checkTheGuess(htmlentities($_GET['guessedNumber']));
//                 }
//
//                 $lastWord = \Anna\Guess\Result::setClassOnH3($comparison);
//                 ?>
//
//                    <!-- Måste använda $_GET['guessedNumber'] här. Om $guess->guessedNumber sparas/skrivs inte det gissade numret ut. -->
//
//                  <?php
//
//                 $result =  "<h4>The guessed number </h4>" . "<h3 class='$lastWord'>" . htmlentities($_GET['guessedNumber']) . "</h3>" . "<h4>  is  </h4>" . "<h3  class='$lastWord'>" . $comparison . "</h3>"
//                 . "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft();
//             }
//         } else {
//             // $exception = False;
//                ?>
//                <?php
//
//             $result = "<h3>Sorry, you have no guesses left!</h3>" .
//                 "<h3>The correct number was " . $guess->getTheNumber() . ". </h3>";
//         }
//     } ?> <?php
// } catch (\Exception $e) { ?>
//        <?php
//
//     $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
//
//     // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
// }


?>

<!-- Formuläret måste ligga EFTER try/catch-satsen annars räknas noGuessesLeft ner även vid ett exception. -->

<div class="form-wrap ">

<?php


// Display the result

\Anna\Guess\Result::displayResult($result);

// Test 180920
$else = ($done === "true" ? "disabled" : "");
$form = new \Anna\Guess\Form($done, $else, $guessedNumber, $guess->getTheNumber(), $guess->getNoGuessesLeft()-1);

$form->displayForm("get", "get");

// Test 180920
$formCheat = new \Anna\Guess\Form($done, $else, null, $guess->getTheNumber(), $guess->getNoGuessesLeft());

$formCheat->displayForm("get", "get", true);


// $form->getCurrentUrl();

?>

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
