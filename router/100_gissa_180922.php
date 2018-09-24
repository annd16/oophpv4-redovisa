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
        $result = \Anna\Guess\Result::getResult($resCode, htmlentities($_GET['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft());
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
            $result = \Anna\Guess\Result::getResult($resCode, htmlentities($_GET['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft(), $extraMessage);
        } catch (\Exception $e) {
            // $result = "<h3>Caught exception:</h3>" . "<h4>" . $e->getMessage() . "</h4>" . "<h4 class='guessesleft'>Number of guesses left: " . ($guess->getNoGuessesLeft() > 0 ? $guess->getNoGuessesLeft() : "none.") . "</h4>";
            $resCode = "anException";
            echo "resCode = " . $resCode;
            $extraMessage = $e->getMessage();
            $result = \Anna\Guess\Result::getResult($resCode, htmlentities($_GET['guessedNumber']), $guess->getTheNumber(), $guess->getNoGuessesLeft(), $extraMessage);
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
        // "guessedNumber" => $_GET['guessedNumber'],
        // "result" => "Hello1!",  // Fungerar!
        "result" => $result,  // Fungerar!
    ];
    $title = "Guess-get as a page";
    // $guessedNumber = $_GET['guessedNumber'];
    // $guessedNumber = null;
    // $class2 = "get";
    // $method = "get";
    // $guess = $guess;
    // $result = "Hello2!";
    $app->view->add("anax/v2/gissa/get/index-get-in", $data);
    return $app->page2->render([
        "title" => $title,
        // "result" => "Hello3",
        "result" => $result,
        // "class2" => "get",
        // "method" => $method,
        // "title" => $title,
        // "done" => $done,     // Fungerar inte!
        // "guess" => $guess
    ]);
});

// Nedanstående fick jag inte att fungera:
// /**
//  * Displaying the 'Guess my number'-game, not using the standard page layout.
//  */
// $app->router->get("gissa/get", function () use ($app) {
//     // include __DIR__ . "/../htdocs/guess/index-get-in.php";
//     $data = [
//         "class" => "hello-world",
//         // "content" => "Hello World in " . __FILE__,
//         "content" => include __DIR__ . "/../htdocs/guess/index-get-in.php",
//     ];
//     $title = "Guess-get as a page";
//     // $app->view->add("anax/v2/gissa/get/index-get-in", $data);
//     $app->view->add("anax/v2/article/default", $data);
//     return $app->page->render([
//         "title" => $title,
//     ]);
// });

/**
 * Displaying the 'Guess my number'-game, not using the standard page layout.
 */
$app->router->get("gissa/post", function () use ($app) {
    $data = [
        "class" => "guess",
        "content" => "Hello World in " . __FILE__,
        "mount" => "gissa"
    ];
    $title = "Guess-post as a page";
    $app->view->add("anax/v2/gissa/post/index-post-in", $data);
    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Displaying the 'Guess my number'-game, not using the standard page layout.
 */
$app->router->get("gissa/session", function () use ($app) {
    $data = [
        "class" => "guess",
        "content" => "Hello World in " . __FILE__,
        "mount" => "gissa"
    ];
    $title = "Guess-session as a page";
    $app->view->add("anax/v2/gissa/session/index-session-in", $data);
    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Displaying the 'Guess my number'-game, not using the standard page layout.
 */
$app->router->get("gissa/session-object", function () use ($app) {
    $data = [
        "class" => "guess",
        "content" => "Hello World in " . __FILE__,
        "mount" => "gissa"
    ];
    $title = "Guess-session-object as a page";
    $app->view->add("anax/v2/gissa/session-object/index-session-object-in", $data);
    return $app->page->render([
        "title" => $title,
    ]);
});


// /**
//  * Returning a JSON message with Hello World.
//  */
// $app->router->get("lek/hello-world-json", function () use ($app) {
//     // echo "Some debugging information";
//     return [["message" => "Hello World"]];
// });
//
//
//
// /**
// * Showing message Hello World, rendered within the standard page layout.
//  */
// $app->router->get("lek/hello-world-page", function () use ($app) {
//     $title = "Hello World as a page";
//     $data = [
//         "class" => "hello-world",
//         "content" => "Hello World in " . __FILE__,
//     ];
//
//     $app->page->add("anax/v2/article/default", $data);
//
//     return $app->page->render([
//         "title" => $title,
//     ]);
// });
