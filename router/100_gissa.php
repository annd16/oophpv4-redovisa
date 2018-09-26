<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Displaying the 'Guess my number'-game, not using the standard page layout.
 */
$app->router->get("gissa/get", function () use ($app) {

    // namespace Anna\Guess;

    require __DIR__ . "/../htdocs/guess/config.php";
    // require __DIR__ . "/../../../../../vendor/autoload.php";

    $guess = null;
    $done = "false";
    $guessedNumber = null;
    $result = "";

    if (!isset($_GET['theNumber'])) {
        // echo("Before the first guess, default parameters 'injected' in the object.<br/>");
        $guess = new Anna\Guess\Guess();

        // Creating a random number:
        $guess->createTheNumber();
    } else {
        $guess = new Anna\Guess\Guess($_GET['theNumber'], $_GET['noGuessesLeft']);
    }

    // Test 180922
    // <!-- För att resultat-diven ska visas även innan några gissningar gjorts:  -->
    if (!isset($_GET['guessedNumber'])) {
        $result = "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
            "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft();
    }

    // // Test 180922
    if (isset($_GET["cheat"])) {
        $resCode = "cheat";
        echo "resCode = " . $resCode;
        $result = \Anna\Result\Result::getResult($resCode, htmlentities($_GET['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft());
        // $result = "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";

        // For each guess
    } else if (isset($_GET['guessedNumber'])) {
        try {
            $guess->checkIfOutOfBounds(htmlentities($_GET['guessedNumber']));
            $comparison = $guess->checkTheGuess(htmlentities($_GET['guessedNumber']));
            if ($_GET['guessedNumber'] === $guess->getTheNumber()) {
                $done = "true";
                // echo "The number is correct!";
            }
            $resCode = $guess->checkNoGuessesLeft();
            echo "resCode = " . $resCode;
            $extraMessage = $comparison;
            $result = \Anna\Result\Result::getResult($resCode, htmlentities($_GET['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft(), $extraMessage);
        } catch (\Exception $e) {
            // $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
            $resCode = "anException";
            echo "resCode = " . $resCode;
            $extraMessage = $e->getMessage();
            $result = \Anna\Result\Result::getResult($resCode, htmlentities($_GET['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft(), $extraMessage);
            // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
        }
    }

    // include __DIR__ . "/../htdocs/gissa/index-get-in.php";
    $data = [
        "class" => "guess",
        "content" => "Hello World in " . __FILE__,
        "mount" => "gissa",
        "method" => "get",
        "class2" => "get",
        "done" => $done,            // Fungerar ==> och man kan referera till variabeln med variabelnamnet $done, behöver INTE skriva $data['done'] i index-get-in.php!
        "guess" => $guess,            // Fungerar!
        "guessedNumber" => $guessedNumber,
        // "result" => "Hello1!",  // Fungerar!
        "result" => $result,  // Fungerar!
    ];
    $title = "Guess-get as a page";
    $app->view->add("anax/v2/gissa/guess_view", $data);
    return $app->page2->render([
        "title" => $title,
        // "result" => $result,
    ]);
});



/**
 * Displaying the 'Guess my number'-game, not using the standard page layout.
 */
// $app->router->get("gissa/post", function () use ($app) {
$app->router->any(["get", "post"], "gissa/post", function () use ($app) {
    // namespace Anna\Guess;

    require __DIR__ . "/../htdocs/guess/config.php";
    // require __DIR__ . "/../../../../../vendor/autoload.php";

    $guess = null;
    $done = "false";
    $guessedNumber = null;
    $result = "";

    if (!isset($_POST['theNumber'])) {
        // echo("Before the first guess, default parameters 'injected' in the object.<br/>");
        $guess = new Anna\Guess\Guess();

        // Creating a random number:
        $guess->createTheNumber();
    } else {
        $guess = new Anna\Guess\Guess($_POST['theNumber'], $_POST['noGuessesLeft']);
    }

    // Test 180922
    // <!-- För att resultat-diven ska visas även innan några gissningar gjorts:  -->
    if (!isset($_POST['guessedNumber'])) {
        $result = "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
            "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft();
    }

    // // Test 180922
    if (isset($_POST["cheat"])) {
        $resCode = "cheat";
        echo "resCode = " . $resCode;
        $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft());
        // $result = "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";

        // For each guess
    } else if (isset($_POST['guessedNumber'])) {
        try {
            $guess->checkIfOutOfBounds(htmlentities($_POST['guessedNumber']));
            $comparison = $guess->checkTheGuess(htmlentities($_POST['guessedNumber']));
            if ($_POST['guessedNumber'] === $guess->getTheNumber()) {
                $done = "true";
                // echo "The number is correct!";
            }
            $resCode = $guess->checkNoGuessesLeft();
            echo "resCode = " . $resCode;
            $extraMessage = $comparison;
            $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft(), $extraMessage);
        } catch (\Exception $e) {
            // $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
            $resCode = "anException";
            echo "resCode = " . $resCode;
            $extraMessage = $e->getMessage();
            $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft(), $extraMessage);
            // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
        }
    }

    // include __DIR__ . "/../htdocs/gissa/index-get-in.php";
    $data = [
        "class" => "guess",
        "content" => "Hello World in " . __FILE__,
        "mount" => "gissa",
        "method" => "post",
        "class2" => "post",
        "done" => $done,            // Fungerar ==> och man kan referera till variabeln med variabelnamnet $done, behöver INTE skriva $data['done'] i index-get-in.php!
        "guess" => $guess,            // Fungerar!
        "guessedNumber" => $guessedNumber,
        // "result" => "Hello1!",  // Fungerar!
        "result" => $result,  // Fungerar!
    ];
    $title = "Guess-post as a page";
    $app->view->add("anax/v2/gissa/guess_view", $data);
    return $app->page2->render([
        "title" => $title,
        // "result" => $result,
    ]);
});


/**
 * Displaying the 'Guess my number'-game, not using the standard page layout.
 */
$app->router->any(["get", "post"], "gissa/session", function () use ($app) {

    require __DIR__ . "/../htdocs/guess/config.php";
    // require __DIR__ . "/../../../../../vendor/autoload.php";


    // // Starts the session and gives it a unique name:
    // $sessionName = substr(preg_replace('/[^a-z\d]/i', '', __DIR__), -30);
    // \Anna\Session\Session::setName($sessionName);
    // \Anna\Session\Session::start();

    $guess = null;
    $done = "false";
    $guessedNumber = null;
    $result = "";
    $resCode = "";
    $mount = "gissa";

    // $session = $di->get("session");


    // // TESTAR MED HEADER REDIRECT VID RESET
    // if (isset($_GET['reset'])) {
    //     # Redirect to another page
    //
    //     die("This is the reset link");
    //
    //     header("Location: \Anax\View\url($mount.'session')");
    //     exit;
    // }

    // TESTAR ATT AVSLUTA SESSIONEN MED HEADER REDIRECT
    if (isset($_GET['destroy'])) {
        # Delete cookies and kill session
        // $app->session = $di->get("session");
        $app->session->destroy($app->session->get("name"));

        ?><h1>Session destroyed</h1>

        <p>The session is now destroyed.</p>

        <pre><?= var_dump($app->session) ?></pre>

        <?php

        echo "\$mount = " . $mount;
        // die();
        // Nedanstående fungerar!
        header("Location: " . \Anax\View\url($mount.'/session'));
        // exit;

        // Test för att försöka döda ramverkets session?

        // Show incoming variables and view helper functions
        //echo showEnvironment(get_defined_vars(), get_defined_functions());


        //
        // ?><h1>Session destroyed</h1>

    <?php
    }

    ?> <p>The session contains the following data.</p>

    <pre><?= var_dump($app->session) ?></pre> <?php

    echo "<p>Allt innehåll i arrayen \$_SESSION:<br><pre>" . htmlentities(print_r($_SESSION, 1)) . "</pre>";




    // if (!isset($_POST['theNumber'])) {
    if (!isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) {
        // echo("Before the first guess, default parameters 'injected' in the object.<br/>");
        $guess = new \Anna\Guess\Guess();

        // Creating a new random number:
        $guess->createTheNumber();
        // And store it in the session-array:
        $theNumber = $guess->getTheNumber();
        \Anna\Session\Session::set("theNumber", $theNumber);

        $noGuessesLeft = $guess->getNoGuessesLeft();   // Borde här bli 6
        // Store the number of guesses left in the session array:
        \Anna\Session\Session::set('noGuessesLeft', $noGuessesLeft);

        // echo "<br/>theNumber in new Guess: " . Session::get('theNumber');
        // echo "<br/>theNumber in new Guess: " . $_SESSION['theNumber'];
        // echo "<br/>noGuessesLeft in new Guess: " . $_SESSION['noGuessesLeft'];
        // echo "<br/>noGuessesLeft in new Guess: " . $noGuessesLeft;
    } elseif (isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) {
        // echo "After a guess has been made, create a new Guess-object with session parameters:";
        // $guess = new \Anna\Guess\Guess(htmlentities($guess->getTheNumber()), htmlentities(\Anna\Session\Session::get('noGuessesLeft')));
        $guess = new \Anna\Guess\Guess(htmlentities(\Anna\Session\Session::get('theNumber')), htmlentities(\Anna\Session\Session::get('noGuessesLeft')));

        // echo "<br/>noGuessesLeft = " . $guess->getNoGuessesLeft();
        // echo "<br/>theNumber after a Guess has been made: " . SESSION::get('theNumber');
        // echo "<br/>noGuessesLeft after a Guess has been made: " . SESSION::get('noGuessesLeft');
    }
    ?>
    <!-- För att resultat-diven ska visas även innan några gissningar gjorts:  -->
    <?php if (!isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) { ?>
            <?php $result = "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
                "<h4 class='guessesleft'>Number of guesses left: " . $guess->getNoGuessesLeft(); ?>
    <?php
}
    ?>

    <?php

    // // Test 180922
    if (isset($_POST["cheat"])) {
        // // ***** Test 180923 för att göra så att programmet inte räknar ner vid om "cheat" : *****
        echo "\$resCode = " . $resCode;
        echo "\$resCode !== 'cheat' = " . ($resCode !== 'cheat');
        echo "!isset(\$theArray['cheat']) = " . (!isset($theArray['cheat']));
        $noGuessesLeft = \Anna\Session\Session::get('noGuessesLeft');
        $noGuessesLeft += 1;
        // $guess->setNoGuessesLeft($noGuessesLeft);
        // echo "<br>guess->getNoGuessesLeft() inside try: " . $guess->getNoGuessesLeft();
        \Anna\Session\Session::set('noGuessesLeft', $noGuessesLeft);
        echo "\Anna\Session\Session::get('noGuessesLeft') = " . \Anna\Session\Session::get('noGuessesLeft');
        // ************* Slut på testet **************


        $resCode = "cheat";
        echo "resCode = " . $resCode;
        // $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), $guess->getTheNumber(), \Anna\Session\Session::get('noGuessesLeft'));
        $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), \Anna\Session\Session::get('theNumber'), \Anna\Session\Session::get('noGuessesLeft'));

        // $result = "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";

        // For each guess
    } else if (isset($_POST['guessedNumber'])) {
        try {
            $guess->checkIfOutOfBounds(htmlentities($_POST['guessedNumber']));
            $comparison = $guess->checkTheGuess(htmlentities($_POST['guessedNumber']));
            echo "\$comparison = " . $comparison;
            echo "(\$_POST['guessedNumber'] = " . ($_POST['guessedNumber']);
            var_dump($_POST['guessedNumber']);
            echo "\$_POST['guessedNumber'] === \$guess->getTheNumber() = " . ($_POST['guessedNumber'] === $guess->getTheNumber());
            if ($_POST['guessedNumber'] === $guess->getTheNumber()) {
                $done = "true";
                // echo "The number is correct!";
            }
            $resCode = $guess->checkNoGuessesLeft();
            echo "resCode = " . $resCode;

            // // ***** Test 180923 för att få nedräkningen att fungera: *****
            // if ($resCode === "aboveZeroLeft") {
            //     $noGuessesLeft = \Anna\Session\Session::get('noGuessesLeft');
            //     $noGuessesLeft -= 1;
            //     $guess->setNoGuessesLeft($noGuessesLeft);
            //     echo "<br>guess->getNoGuessesLeft() inside try: " . $guess->getNoGuessesLeft();
            //     \Anna\Session\Session::set('noGuessesLeft', $noGuessesLeft);
            //     echo "\Anna\Session\Session::get('noGuessesLeft') = " . \Anna\Session\Session::get('noGuessesLeft');
            // }
            // // ************* Slut på testet **************

            $extraMessage = $comparison;
            $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft(), $extraMessage);
        } catch (\Exception $e) {
            $noGuessesLeft = \Anna\Session\Session::get('noGuessesLeft');
            $noGuessesLeft += 1;
            \Anna\Session\Session::set('noGuessesLeft', $noGuessesLeft);
            echo "\Anna\Session\Session::get('noGuessesLeft') = " . \Anna\Session\Session::get('noGuessesLeft');
            // $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
            $resCode = "anException";
            echo "resCode = " . $resCode;
            $extraMessage = $e->getMessage();
            $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft(), $extraMessage);
            // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
        }
    }

    // include __DIR__ . "/../htdocs/gissa/index-get-in.php";
    $data = [
        "class" => "guess",
        "content" => "Hello World in " . __FILE__,
        // "mount" => "gissa",
        "mount" => $mount,
        "method" => "post",
        "class2" => "session",
        "done" => $done,            // Fungerar ==> och man kan referera till variabeln med variabelnamnet $done, behöver INTE skriva $data['done'] i index-get-in.php!
        "guess" => $guess,            // Fungerar!
        "guessedNumber" => $guessedNumber,
        // "result" => "Hello1!",  // Fungerar!
        "result" => $result,  // Fungerar!
        "resCode" => $resCode
    ];
    $title = "Guess-session as a page";
    // $app->view->add("anax/v2/gissa/session/index-session-in", $data);
    $app->view->add("anax/v2/gissa/guess_view", $data);
    return $app->page2->render([
        "title" => $title,
        // "result" => $result,
    ]);
});




/**
 * Displaying the 'Guess my number'-game, not using the standard page layout.
 */
$app->router->any(["get", "post"], "gissa/session-object", function () use ($app) {

    require __DIR__ . "/../htdocs/guess/config.php";
    // require __DIR__ . "/../../../../../vendor/autoload.php";


    // // Starts the session and gives it a unique name:
    // $sessionName = substr(preg_replace('/[^a-z\d]/i', '', __DIR__), -30);
    // \Anna\Session\Session::setName($sessionName);
    // \Anna\Session\Session::start();

    $guess = null;
    $done = "false";
    $guessedNumber = null;
    $result = "";
    $resCode = "";
    $mount = "gissa";

    // $session = $di->get("session");


    // // TESTAR MED HEADER REDIRECT VID RESET
    // if (isset($_GET['reset'])) {
    //     # Redirect to another page
    //
    //     die("This is the reset link");
    //
    //     header("Location: \Anax\View\url($mount.'session')");
    //     exit;
    // }

    // TESTAR ATT AVSLUTA SESSIONEN MED HEADER REDIRECT
    if (isset($_GET['destroy'])) {
        # Delete cookies and kill session
        // $app->session = $di->get("session");
        $app->session->destroy($app->session->get("name"));

        ?><h1>Session destroyed</h1>

        <p>The session is now destroyed.</p>

        <pre><?= var_dump($app->session) ?></pre>

        <?php

        echo "\$mount = " . $mount;
        // die();
        // Nedanstående fungerar!
        header("Location: " . \Anax\View\url($mount.'/session-object'));
        // exit;

        // Test för att försöka döda ramverkets session?

        // Show incoming variables and view helper functions
        //echo showEnvironment(get_defined_vars(), get_defined_functions());


        //
        // ?><h1>Session destroyed</h1>

    <?php
    }

    ?> <p>The session contains the following data.</p>

    <pre><?= var_dump($app->session) ?></pre> <?php

    echo "<p>Allt innehåll i arrayen \$_SESSION:<br><pre>" . htmlentities(print_r($_SESSION, 1)) . "</pre>";




    // if (!isset($_POST['theNumber'])) {
    if (!isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) {


        // // *******************************************
        // // echo("Before the first guess, default parameters 'injected' in the object.<br/>");
        // $guess = new \Anna\Guess\Guess();
        // // Store the guess object in session
        // \Anna\Session\Session::set('guess', $guess);
        //
        // // Creating a new random number:
        // // $guess->createTheNumber();
        // $theNumber = \Anna\Session\Session::get('guess')->createTheNumber();
        //
        // echo "\Anna\Session\Session::get('guess') = ";
        // var_dump(\Anna\Session\Session::get('guess'));
        //
        // // And store it in the session-array:
        // // $theNumber = $guess->getTheNumber();
        // // \Anna\Session\Session::set("theNumber", $theNumber);
        //
        // $noGuessesLeft = \Anna\Session\Session::get('guess')->getNoGuessesLeft();   // Borde här bli 6
        // //******************************************

        // omtänk 180926

        $guess = new \Anna\Guess\Guess();
        $guess->createTheNumber();
        // $noGuessesLeft = $guess->getNoGuessesLeft();   // Borde här bli 6

        // Store the object in session:
        \Anna\Session\Session::set('guess', $guess);

        // Store the number of guesses left in the session array:
        // \Anna\Session\Session::set("noGuessesLeft", $noGuessesLeft);



        // echo "<br/>theNumber in new Guess: " . Session::get('theNumber');
        // echo "<br/>theNumber in new Guess: " . $_SESSION['theNumber'];
        // echo "<br/>noGuessesLeft in new Guess: " . $_SESSION['noGuessesLeft'];
        // echo "<br/>noGuessesLeft in new Guess: " . $noGuessesLeft;
    } elseif (isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) {
        // echo "After a guess has been made, create a new Guess-object with session parameters:";
        // $guess = new \Anna\Guess\Guess(htmlentities($guess->getTheNumber()), htmlentities(\Anna\Session\Session::get('noGuessesLeft')));
        $guess = new \Anna\Guess\Guess(htmlentities(\Anna\Session\Session::get('guess')->getTheNumber()), htmlentities(\Anna\Session\Session::get('guess')->getNoGuessesLeft()));   // Borde här bli 6));

        // echo "<br/>noGuessesLeft = " . $guess->getNoGuessesLeft();
        // echo "<br/>theNumber after a Guess has been made: " . SESSION::get('theNumber');
        // echo "<br/>noGuessesLeft after a Guess has been made: " . SESSION::get('noGuessesLeft');
    }
    ?>
    <!-- För att resultat-diven ska visas även innan några gissningar gjorts:  -->
    <?php if (!isset($_POST['guessedNumber']) && !isset($_POST['cheat'])) { ?>
            <?php $result = "<h4 class='noguessesmade'>No guesses has been made yet!</h4> " .
                "<h4 class='guessesleft'>Number of guesses left: " .\Anna\Session\Session::get('guess')->getNoGuessesLeft(); ?>
    <?php
}
    ?>

    <?php

    // // Test 180922
    if (isset($_POST["cheat"])) {
        // // ***** Test 180923 för att göra så att programmet inte räknar ner om "cheat" : *****
        echo "\$resCode = " . $resCode;
        echo "\$resCode !== 'cheat' = " . ($resCode !== 'cheat');
        echo "!isset(\$theArray['cheat']) = " . (!isset($theArray['cheat']));
        $noGuessesLeft = \Anna\Session\Session::get('guess')->getNoGuessesLeft();
        $noGuessesLeft += 1;
        // $guess->setNoGuessesLeft($noGuessesLeft);
        // echo "<br>guess->getNoGuessesLeft() inside try: " . $guess->getNoGuessesLeft();
        // 180926
        // \Anna\Session\Session::set('noGuessesLeft', $noGuessesLeft);
        \Anna\Session\Session::get('guess')->setNoGuessesLeft($noGuessesLeft);
        echo "\Anna\Session\Session::get('noGuessesLeft') = " . Anna\Session\Session::get('guess')->getNoGuessesLeft();
        // ************* Slut på testet **************


        $resCode = "cheat";
        echo "resCode = " . $resCode;
        // $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), $guess->getTheNumber(), \Anna\Session\Session::get('noGuessesLeft'));
        // $result = \Anna\Result\Result::getResult($resCode, htmlentities($_POST['guessedNumber']), \Anna\Session\Session::get('guess')->getTheNumber(), \Anna\Session\Session::get('guess')->getNoGuessesLeft());
        $result = \Anna\Result\Result::getResult($resCode, null, \Anna\Session\Session::get('guess')->getTheNumber(), \Anna\Session\Session::get('guess')->getNoGuessesLeft());

        // $result = "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";

        // For each guess
    } else if (isset($_POST['guessedNumber'])) {
        try {
            $guess->checkIfOutOfBounds($_POST['guessedNumber']);
            echo "\Anna\Session\Session::get('guess')->getNoGuessesLeft() after checkIfOutOfBounds = " . \Anna\Session\Session::get('guess')->getNoGuessesLeft();
            $comparison = $guess->checkTheGuess($_POST['guessedNumber']);
            echo "\$comparison = " . $comparison;
            echo "(\$_POST['guessedNumber'] = " . ($_POST['guessedNumber']);
            var_dump($_POST['guessedNumber']);
            echo "(\Anna\Session\Session::get('guess')->getTheNumber()) = " . (\Anna\Session\Session::get('guess')->getTheNumber());
            // echo "((int)\$_POST['guessedNumber'] == \Anna\Session\Session::get('guess')->getTheNumber()) = " . (((int)$_POST['guessedNumber']) == \Anna\Session\Session::get('guess')->getTheNumber());
            if ($_POST['guessedNumber'] == (\Anna\Session\Session::get('guess')->getTheNumber())) {
                $done = "true";
                echo "The number is correct!";
            }
            $resCode = \Anna\Session\Session::get('guess')->checkNoGuessesLeft();
            echo "resCode = " . $resCode;

            // // ***** Test 180923 för att få nedräkningen att fungera: *****
            // if ($resCode === "aboveZeroLeft") {
            //     $noGuessesLeft = \Anna\Session\Session::get('noGuessesLeft');
            //     $noGuessesLeft -= 1;
            //     $guess->setNoGuessesLeft($noGuessesLeft);
            //     echo "<br>guess->getNoGuessesLeft() inside try: " . $guess->getNoGuessesLeft();
            //     \Anna\Session\Session::set('noGuessesLeft', $noGuessesLeft);
            //     echo "\Anna\Session\Session::get('noGuessesLeft') = " . \Anna\Session\Session::get('noGuessesLeft');
            // }
            // // ************* Slut på testet **************

            $extraMessage = $comparison;
            $result = \Anna\Result\Result::getResult($resCode, $_POST['guessedNumber'], \Anna\Session\Session::get('guess')->getTheNumber(), \Anna\Session\Session::get('guess')->getNoGuessesLeft(), $extraMessage);
        // } catch (\Exception $e) {
        //     $noGuessesLeft = \Anna\Session\Session::get('guess')->getNoGuessesLeft();
        //     echo ("\$noGuessesLeft = " . $noGuessesLeft);
        //     $noGuessesLeft += 1;
        //     echo ("\$noGuessesLeft = " . $noGuessesLeft);
        //     \Anna\Session\Session::get('guess')->setNoGuessesLeft('noGuessesLeft', $noGuessesLeft);
        //     echo "\Anna\Session\Session::get('guess')->getNoGuessesLeft() = " . \Anna\Session\Session::get('guess')->getNoGuessesLeft();
        //     // $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
        //     $resCode = "anException";
        //     echo "resCode = " . $resCode;
        //     $extraMessage = $e->getMessage();
        //     $result = \Anna\Result\Result::getResult($resCode, $_POST['guessedNumber'], \Anna\Session\Session::get('guess')->getTheNumber(), \Anna\Session\Session::get('guess')->getNoGuessesLeft(), $extraMessage);
        //     // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
        // }
        } catch (\Exception $e) {
            echo "\Anna\Session\Session::get('guess')->getNoGuessesLeft() in the beginning of catch = " . \Anna\Session\Session::get('guess')->getNoGuessesLeft();  // Blir rätt här!!!
            $guessObject = \Anna\Session\Session::get('guess');
            $noGuessesLeft = $guessObject->getNoGuessesLeft();
            echo ("\$noGuessesLeft in catch = " . $noGuessesLeft);
            $noGuessesLeft += 1;
            echo ("\$noGuessesLeft in catch = " . $noGuessesLeft);      // Blir rätt här också!!!
            // $guessObject->setNoGuessesLeft('noGuessesLeft', $noGuessesLeft);
            $guessObject->setNoGuessesLeft($noGuessesLeft);
            var_dump($guessObject);
            \Anna\Session\Session::set('guess', $guessObject);
            echo "\Anna\Session\Session::get('guess')->getNoGuessesLeft() = " . \Anna\Session\Session::get('guess')->getNoGuessesLeft();
            // $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
            $resCode = "anException";
            echo "resCode = " . $resCode;
            $extraMessage = $e->getMessage();
            $result = \Anna\Result\Result::getResult($resCode, $_POST['guessedNumber'], \Anna\Session\Session::get('guess')->getTheNumber(), \Anna\Session\Session::get('guess')->getNoGuessesLeft(), $extraMessage);
            // echo "<br>guess->noGuessesLeft inside catch: " . $guess->noGuessesLeft; // Test
        }
    }

    // include __DIR__ . "/../htdocs/gissa/index-get-in.php";
    $data = [
        "class" => "guess",
        "content" => "Hello World in " . __FILE__,
        // "mount" => "gissa",
        "mount" => $mount,
        "method" => "post",
        "class2" => "session-object",
        "done" => $done,            // Fungerar ==> och man kan referera till variabeln med variabelnamnet $done, behöver INTE skriva $data['done'] i index-get-in.php!
        "guess" => $guess,            // Fungerar!
        "guessedNumber" => $guessedNumber,
        // "result" => "Hello1!",  // Fungerar!
        "result" => $result,  // Fungerar!
        "resCode" => $resCode
    ];
    $title = "Guess-session-object as a page";
    // $app->view->add("anax/v2/gissa/session/index-session-in", $data);
    $app->view->add("anax/v2/gissa/guess_view", $data);
    return $app->page2->render([
        "title" => $title,
        // "result" => $result,
    ]);
});
