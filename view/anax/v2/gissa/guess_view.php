<?php

// namespace Anna\Guess;
namespace Anax\View;

/****************
* Get vyn:s template fil
*
*/

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

    <main class= <?= $class2 ?>>

        <title>Guess my number - <?= strtoupper($class2) ?> </title>

        <h1 class="h1-<?= $class2 ?>">A guessing game with <?= strtoupper($class2) ?> </h1>

        <navbar class=navbar>
            <a href="<?= url($mount) ?>">Return to start page</a>
            <a href="<?= url($mount."/".$class2) ?>">Reset game</a>
            <!-- <a href="<?= \Anax\View\url($mount) ?>">Return to start page</a>
            <a href="../gissa/session">Reset game</a> -->
<?php if ($class2 === "session" || $class2 === "session-object") {
    echo "<a href=" . url($mount."/" . $class2) . "?destroy=true>Kill session</a>";
} ?>
        </navbar>

        <?php

        if ($data["method"] === "get") {
            $theArray = $_GET;
            // echo "GET!";
        } else {
            $theArray = $_POST;
        }

        ?>

        <div class="thenumber <?= isset($theArray['cheat']) ? " visible" : " hidden" ?>">
        <?php if ($class2 === "session") : ?>
            <?= "<p>The number is: " . \Anna\Session\Session::get('theNumber') . "</p>"; ?>
        <?php elseif ($class2 === "session-object") : ?>
            <?= "<p>The number is: " . \Anna\Session\Session::get('guess')->getTheNumber() . "</p>"; ?>
        <?php else : ?>
            <?= "<p>The number is: " . $guess->getTheNumber() . "</p>"; ?>
        <?php endif ?>

        </div>


        <?php

        // // ***** Test 180923 för att få nedräkningen att fungera i 'NORMALFALLET' i session-varianterna: *****
        // if ($resCode === "aboveZeroLeft") {             // Om denna jämförelse så börjar inte nerräkningen efter första gissningen utan andra.
        // if (($class2 === "session" || $class2 === "session-object") && ($resCode !== "anException" && $resCode !== "cheat")) {
        if ($class2 === "session" || $class2 === "session-object") {
            echo "\$resCode = " . $resCode;
            echo "\$resCode !== 'cheat' = " . ($resCode !== 'cheat');
            echo "!isset(\$theArray['cheat']) = " . (!isset($theArray['cheat']));
            // if ($resCode !== "anException" && $resCode !== "cheat" && !isset($theArray['cheat'])) {
            // if (($resCode === "anException" || $resCode === "cheat" || isset($theArray['cheat']))) {
            //     echo "No countdown!";
            //     $noGuessesLeft = \Anna\Session\Session::get('noGuessesLeft');
            //     $noGuessesLeft += 1;
            //     // $guess->setNoGuessesLeft($noGuessesLeft);
            //     // echo "<br>guess->getNoGuessesLeft() inside try: " . $guess->getNoGuessesLeft();
            //     \Anna\Session\Session::set('noGuessesLeft', $noGuessesLeft);
            //     echo "\Anna\Session\Session::get('noGuessesLeft') = " . \Anna\Session\Session::get('noGuessesLeft');
            // // }
            // } else {

            if ($class2 === "session") {
                $noGuessesLeft = \Anna\Session\Session::get('noGuessesLeft');
                $noGuessesLeft -= 1;
                \Anna\Session\Session::set('noGuessesLeft', $noGuessesLeft);
                echo "\Anna\Session\Session::get('noGuessesLeft') = " . \Anna\Session\Session::get('noGuessesLeft');
            } elseif ($class2 === "session-object") {
            // } elseif ($class2 === "session-object" && !$guess->checkIfOutOfBounds($guessedNumber)) {       // test 180926 för att få execption att fungera!
                // if (null !== \Anna\Session\Session::get('guess')->getNoGuessesLeft()) {
                $guessObject = \Anna\Session\Session::get('guess');
                $noGuessesLeft = $guessObject->getNoGuessesLeft();
                echo ("\$noGuessesLeft inside view = " . $noGuessesLeft);
                $noGuessesLeft -= 1;
            // }
                echo ("\$noGuessesLeft inside view2 = " . $noGuessesLeft);
                $guessObject->setNoGuessesLeft($noGuessesLeft);
                // \Anna\Session\Session::get('guess')->setNoGuessesLeft($noGuessesLeft);
                \Anna\Session\Session::set('guess', $guessObject);
                echo "\Anna\Session\Session::get('guess')->getNoGuessesLeft() = " . \Anna\Session\Session::get('guess')->getNoGuessesLeft();
                // }
            }
            // }
        }
        // ************* Slut på testet **************

        // Display the result
        \Anna\Result\Result::displayResult($result);

        // echo "\$result = " . $result;


        ?>

        <!-- Formuläret måste ligga EFTER try/catch-satsen annars räknas noGuessesLeft ner även vid ett exception. -->

        <div class="form-wrap ">

        <?php

        // Test 180920
        $else = ($done === "true" ? "disabled" : "");
        if ($class2 === "session" || $class2 === "session-object") {
            $form = new \Anna\Form\Form($done, $else, $guessedNumber);
        } else {
            $form = new \Anna\Form\Form($done, $else, $guessedNumber, $guess->getTheNumber(), $guess->getNoGuessesLeft()-1);
        }

        // $form->displayForm("get", "get");
        $form->displayForm($class2, $method);

        if ($class2 === "session" || $class2 === "session-object") {
            $formCheat = new \Anna\Form\Form($done, $else);
        } else {
            $formCheat = new \Anna\Form\Form($done, $else, null, $guess->getTheNumber(), $guess->getNoGuessesLeft());
        }
        // // Test 180920
        // $formCheat = new \Anna\Form\Form($done, $else, null, $guess->getTheNumber(), $guess->getNoGuessesLeft());

        // $formCheat->displayForm("get", "get", true);
        $formCheat->displayForm($class2, $method, true);


        ?>

    </div>

    <?php

    // isset-satserna måste ligga EFTER formuläret annars nollställs inte inmatningsrutan mellan två gissningar

    // Test 180922

    // if  ($data["method"] === "get") {
    //     $theArray = $_GET;
    //     echo "GET!";
    // } else {
    //     $theArray = $_POST;
    // }

    $theNumber = isset($theArray['theNumber'])
    ? htmlentities($theArray['theNumber'])
    : null;
    // echo "<br/>theNumber after the form: " . $theNumber;

    $guessedNumber = isset($theArray['guessedNumber'])
    ? htmlentities($theArray['guessedNumber'])
    : null;

    $noGuessesLeft = isset($theArray['noGuessesLeft'])
    ? htmlentities($theArray['noGuessesLeft'])
    : null;

    // $theNumber = isset($_GET['theNumber'])
    // ? htmlentities($_GET['theNumber'])
    // : null;
    // // echo "<br/>theNumber after the form: " . $theNumber;
    //
    // $guessedNumber = isset($_GET['guessedNumber'])
    // ? htmlentities($_GET['guessedNumber'])
    // : null;
    //
    // $noGuessesLeft = isset($_GET['noGuessesLeft'])
    // ? htmlentities($_GET['noGuessesLeft'])
    // : null;

    // // Show incoming variables and view helper functions
    // echo showEnvironment(get_defined_vars(), get_defined_functions());


    ?>

</main>

</body>
