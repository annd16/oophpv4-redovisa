<?php

namespace Anna\Guess;

require __DIR__ . "/../config.php";
require __DIR__ . "/../../../../../vendor/autoload.php";

// // Starts the session and gives it a unique name:
// $sessionName = substr(preg_replace('/[^a-z\d]/i', '', __DIR__), -30);
// Session::setName($sessionName);
// Session::start();

// Get session?
$session = $di->get("session");

// $exception = True;
$guessedNumber = null;
$class = "session";
$method = "post";



// TESTAR MED HEADER REDIRECT VID RESET
if (isset($_GET['reset'])) {
    # Redirect to another page
    header("Location: index-session.php");
    exit;
}

// TESTAR ATT AVSLUTA SESSIONEN MED HEADER REDIRECT
if (isset($_GET['destroy'])) {
    # Delete cookies and kill session
    Session::destroy($sessionName);
    Header("Location: index-session.php");
}

// echo "<p>Allt innehåll i arrayen \$_SESSION:<br><pre>" . htmlentities(print_r($_SESSION, 1)) . "</pre>";

?>

<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <title>Guess my number</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../../view/anax/v2/gissa/css/style_guess.css">
</head>

<body class="<?= $data['class'] ?>">

    <main class= <?= $class ?>>

        <title>Guess my number - <?= strtoupper($method) ?> </title>

            <h1 class="h1-<?= $class ?>">A guessing game with <?= strtoupper($class) ?> </h1>

            <navbar class=navbar>
                <a href="index.php">Return to start page</a>
                <a href="index-<?= $class ?>.php?reset=true">Reset game</a>
                <a href="index-<?= $class ?>.php?destroy=true">Kill session</a>
            </navbar>

<?php

$done = "false";

// echo "done = " . $done;

// if (!isset($_POST['theNumber'])) {
if (!isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) {
    // echo("Before the first guess, default parameters 'injected' in the object.<br/>");
    $guess = new Guess();

    // Creating a new random number:
    $guess->createTheNumber();
    // And store it in the session-array:
    $theNumber = $guess->getTheNumber();
    Session::set("theNumber", $theNumber);

    $noGuessesLeft = $guess->getNoGuessesLeft();   // Borde här bli 6
    // Store the number of guesses left in the session array:
    Session::set('noGuessesLeft', $noGuessesLeft);

    // echo "<br/>theNumber in new Guess: " . Session::get('theNumber');

    // echo "<br/>noGuessesLeft in new Guess: " . $noGuessesLeft;
} elseif (isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) {
    // echo "After a guess has been made, create a new Guess-object with session parameters:";
    $guess = new Guess(htmlentities(Session::get('theNumber')), htmlentities(Session::get('noGuessesLeft')));

    // echo "<br/>theNumber in new Guess: " . $_SESSION['theNumber'];
    // echo "<br/>noGuessesLeft in new Guess: " . $_SESSION['noGuessesLeft'];



    // echo "<br/>noGuessesLeft = " . $guess->getNoGuessesLeft();

    // echo "<br/>theNumber after a Guess has been made: " . SESSION::get('theNumber');
    // echo "<br/>noGuessesLeft after a Guess has been made: " . SESSION::get('noGuessesLeft');
} ?>


<div class="thenumber <?= isset($_POST['cheat']) ? " visible" : " hidden" ?>"> <?=
    "<p>theNumber is: " . Session::get('theNumber') . "</p>"; ?>   <!-- $guess är ej definierat här -->
</div>

<!-- För att resultat-diven ska visas även innan några gissningar gjorts:  -->
<?php if (!isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) { ?>
    <div class="result">
        <?= "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
        // "<h4 class='guessesleft'>Number of guesses left: " . Session::get('noGuessesLeft')
        "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() . "</h4>"; ?>
    </div>
<?php
} ?>


<?php


try {
    if (isset($_POST["cheat"])) {
        // echo "<div class='result'><h4 class='guessesleft'>Number of guesses left: " . SESSION::get('noGuessesLeft') . "</div>";
        echo "<div class='result'><h4 class='guessesleft'>Number of guesses left: " . (SESSION::get('noGuessesLeft')  > 0 ? SESSION::get('noGuessesLeft')  : "none.") . "</h4></div>";
        // For each guess
    } else if (isset($_POST['guessedNumber']) && !$guess->checkIfOutOfBounds(htmlentities($_POST['guessedNumber']))) {
        // echo "htmlentities(\$_POST['guessedNumber'] = " . htmlentities($_POST['guessedNumber']);
        $result = $guess->checkTheGuess(htmlentities($_POST['guessedNumber']));

        // Kontroll om guessedNumber är lika med theNumber, i så fall sätts $done tillt true:

        if ($_POST['guessedNumber'] === $guess->getTheNumber()) {
            $done = "true";
            // echo "The number is correct!";
        }

        // if ($guess->getNoGuessesLeft() >= 0) {
        // if (Session::get('noGuessesLeft') > 0) {
        //         $noGuessesLeft = Session::get("noGuessesLeft") - 1;
        //         Session::set("noGuessesLeft", $noGuessesLeft);
        if ($guess->getNoGuessesLeft() > 0) {
                $noGuessesLeft = $guess->getNoGuessesLeft() - 1;
                $guess->setNoGuessesLeft($noGuessesLeft);
                Session::set("noGuessesLeft", $noGuessesLeft);

                // To set class on h3-elements depending on the result of the guess
                $words=[];
                $words = explode(' ', $result);
                $lastWord = array_pop($words);
                $lastWord = substr($lastWord, 0, -1);
                ?>

                <!-- Måste använda $_POST['guessedNumber'] här. Om $guess->guessedNumber sparas/skrivs inte det gissade numret ut. -->

                <div class="result">
                <?= "<h4>The guessed number </h4>" . "<h3 class='$lastWord'>" . htmlentities($_POST['guessedNumber']) . "</h3>" . "<h4>  is  </h4>" . "<h3  class='$lastWord'>" . $result . "</h3>"
                // . "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft()

                // . "<h4 class='guessesleft'>Number of guesses left: " . Session::get('noGuessesLeft')
                . "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft() ?>
                </div>

                <?php
            // }
        } else {
            // $exception = False;
            ?>
            <div class="result">
                <?= "<h3>Sorry, you have no guesses left!</h3>" .
                "<h3>The correct number was " . $guess->getTheNumber() . ". </h3>" ?> <?php ?>
            </div> <?php
        }
    }?> <?php
} catch (\Exception $e) { ?>
    <div class="result">
        <?= "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" .
        // "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft()
        // "<h4 class='guessesleft'>Number of guesses left: " . Session::get('noGuessesLeft')
        // "<h4 class='guessesleft'>Number of guesses left: " .  $guess->getNoGuessesLeft()
        // "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
        "<h4 class='guessesleft'>Number of guesses left: " . (Session::get('noGuessesLeft') > 0 ? Session::get('noGuessesLeft') : "none.") . "</h4>"; ?>
    </div> <?php

    // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
}

// echo "done before form: " . $done;

?>

<!-- Formuläret måste ligga EFTER try/catch-satsen annars räknas noGuessesLeft ner även vid ett exception. -->

<div class="form-wrap ">

    <!-- Formulär för att gissa ett nummer -->
    <form class='form1' action="" method= <?= $method ?>>
        <!-- <input type="number" name="guessedNumber" value='<?= $guessedNumber ?>' <?= (isset($_POST["guessedNumber"]) && ($guess->checkTheGuess($_POST["guessedNumber"]) === "correct!")) ? "disabled" : "" ?>> -->
        <!-- <input type="number" name="guessedNumber" value='<?= $guessedNumber ?>' <?= isset($_POST["done"]) && $_POST["done"] === "true" ? "disabled" : "" ?>> -->
        <input type="number" name="guessedNumber" value='<?= $guessedNumber ?>' <?= $done === "true" ? "disabled" : "" ?>>
        <input type="hidden" name="done" value='<?= $done ?>'>
        <!-- <input class="submit" type="submit" value="Submit guess" <?= isset($_POST["done"]) && $_POST["done"] === "true" ? "disabled" : "" ?>> -->
        <input class="submit" type="submit" value="Submit guess" <?= $done === "true" ? "disabled" : "" ?> >
    </form>

    <form class='form2' action="" method= <?= $method ?>>
        <input type="hidden" name="done" value='<?= $done ?>'>
        <!-- <input class="submit" type="submit" name="cheat" value="Cheat" <?= isset($_POST["done"]) && $_POST["done"] === "true" ? "disabled" : "" ?>> -->
        <input class="submit" type="submit" name="cheat" value="Cheat" <?= $done === "true" ? "disabled" : "" ?>>
    </form>

</div>

<?php

// Om ingen gissning gjorts (dvs $_POST['guessedNumber'] inte finns) och om $_SESSION['theNumber'] är satt
// så ska man hämta värdet i $_SESSION['theNumber']
if (!array_key_exists('guessedNumber', $_POST) && (array_key_exists('theNumber', $_SESSION))) {
    // $theNumber = Session::getOnce('theNumber');      // Testar att kommentera bort denna rad 180914
    $theNumber = Session::get('theNumber');      // Testar att kommentera bort denna rad 180914
    // Samma sak för 'noGuessesLeft'
    // $noGuessesLeft = Session::getOnce('noGuessesLeft');
    $noGuessesLeft = Session::get('noGuessesLeft');

    // echo "<br/>theNumber in array_key_exists: " . $theNumber;
    // echo "<br/>noGuessesLeft in array_key_exists: " . $noGuessesLeft;
}


// isset-satserna måste ligga EFTER formuläret annars nollställs inte inmatningsrutan mellan två gissningar

$guessedNumber = isset($_POST['guessedNumber'])
    ? htmlentities($_POST['guessedNumber'])
    : null;
// echo "<br/>guessedNumber after the form: " . $guessedNumber;
if (isset($guessedNumber) && $guessedNumber !== "null") {
    Session::set("guessedNumber", $guessedNumber);
    // echo "guessedNumber is set in session!";
}


$done = isset($_POST['done'])
    ? htmlentities($_POST['done'])
    : null;
// echo "<br/>done after the form: " . $done;


$noGuessesLeft = isset($_SESSION['noGuessesLeft'])
    ? htmlentities($_SESSION['noGuessesLeft'])
    : null;
// echo "<br/>noGuessesLeft after the form: " . $noGuessesLeft;

// echo "<p>Allt innehåll i arrayen \$_SESSION:<br><pre>" . htmlentities(print_r($_SESSION, 1)) . "</pre>";

?>

    </main>

</body>
