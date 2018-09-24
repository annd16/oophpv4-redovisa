<!-- index.php -->

<?php

const MAX_NO_GUESSES = 6;

/************************************
* This is the index-page of the game
* via den kan man nå de olika varianterna av spelet
************************************/

require "config.php";
// require "Guess.php";
// require "Session.php";


?>

<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0">
    <title>Guess my number</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<main class="index">

    <title>Guess my number</title>
    <h1>A guessing game</h1>
    <div class=index>
        <p>This is a game in which you shall try to guess the number I'm thinking of.</p>
        <p>The number is between 1 and 100.</p>
        <p>Max number of allowed guesses: <?= MAX_NO_GUESSES ?> .</p>

        <p>Choose between these four games: </p>
        <ul>
            <li><a href="index-get.php">GET</a></li>
            <li><a href="index-post.php">POST</a></li>
            <li><a href="index-session.php">SESSION</a></li>
            <li><a href="index-session-object.php">SESSION OBJECT</a></li>
        </ul>
    </div>

<h1> I Index.php i guess/htdocs-mappen!!! </h1>

</main>

</body>
