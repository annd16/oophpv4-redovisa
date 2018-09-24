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

        <?php

        if  ($data["method"] === "get") {
            $theArray = $_GET;
            echo "GET!";
        } else {
            $theArray = $_POST;
        }

        ?>

        <div class="thenumber <?= isset($theArray['cheat']) ? " visible" : " hidden" ?>"> <?=
        "<p>The number is: " . $guess->getTheNumber() . "</p>"; ?>
    </div>


    <!-- Formuläret måste ligga EFTER try/catch-satsen annars räknas noGuessesLeft ner även vid ett exception. -->

    <div class="form-wrap ">

        <?php

        // Test 180922
        $request = $di->get("request");

        ?><h1>Request</h1>

        <p>Here are details on the current request.</p>

        <table>
            <tr>
                <th>Method</th>
                <th>Result</th>
            </tr>
            <tr>
                <td><code>getCurrentUrl()</code></td>
                <td><code><?= $request->getCurrentUrl() ?></code></td>
            </tr>
            <tr>
                <td><code>getMethod()</code></td>
                <td><code><?= $request->getMethod() ?></code></td>
            </tr>
            <tr>
                <td><code>getSiteUrl()</code></td>
                <td><code><?= $request->getSiteUrl() ?></code></td>
            </tr>
            <tr>
                <td><code>getBaseUrl()</code></td>
                <td><code><?= $request->getBaseUrl() ?></code></td>
            </tr>
            <tr>
                <td><code>getScriptName()</code></td>
                <td><code><?= $request->getScriptName() ?></code></td>
            </tr>
            <tr>
                <td><code>getRoute()</code></td>
                <td><code><?= $request->getRoute() ?></code></td>
            </tr>
            <tr>
                <td><code>getRouteParts()</code></td>
                <td><code><?= "[ " . implode(", ", $request->getRouteParts()) . " ]" ?></code></td>
            </tr>
        </table> <?php


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




    ?>

</main>

</body>
