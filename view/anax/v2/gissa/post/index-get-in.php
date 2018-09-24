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

    <main class= <?= $data["method"] ?>>

        <title>Guess my number - <?= strtoupper($data["method"]) ?> </title>

        <h1 class="h1-<?= $class2 ?>">A guessing game with <?= strtoupper($data["method"]) ?> </h1>

        <navbar class=navbar>
            <a href="<?= url($mount) ?>">Return to start page</a>
            <a href="<?= url($mount."/".$class2) ?>">Reset game</a>
        </navbar>


        <div class="thenumber <?= isset($_GET['cheat']) ? " visible" : " hidden" ?>"> <?=
        "<p>theNumber is: " . $guess->getTheNumber() . "</p>"; ?>
    </div>


    <!-- Formuläret måste ligga EFTER try/catch-satsen annars räknas noGuessesLeft ner även vid ett exception. -->

    <div class="form-wrap ">

        <?php

        // Display the result

        \Anna\Guess\Result::displayResult($result);

        // echo "\$result = " . $result;

        // Test 180920
        $else = ($done === "true" ? "disabled" : "");
        $form = new \Anna\Guess\Form($done, $else, $guessedNumber, $guess->getTheNumber(), $guess->getNoGuessesLeft()-1);

        // $form->displayForm("get", "get");
        $form->displayForm($class2, $method);

        // Test 180920
        $formCheat = new \Anna\Guess\Form($done, $else, null, $guess->getTheNumber(), $guess->getNoGuessesLeft());

        // $formCheat->displayForm("get", "get", true);
        $formCheat->displayForm($class2, $method, true);


        ?>

    </div>

    <?php

    // isset-satserna måste ligga EFTER formuläret annars nollställs inte inmatningsrutan mellan två gissningar

    // Test 180922

    if  ($method === "get") {
        $theArray = $_GET;
        echo "GET!";
    } else {
        $theArray = $_POST;
    }

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




    ?>

</main>

</body>
