<?php

namespace Anax\View;

/**
 * A layout rendering views in defined regions.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$mount = $mount ?? null; // Where are the routes mounted
$app->session = $di->get("session");
$number = $app->session->get("number", 0);
$app->session->set("number", ++$number);



?><h1>Session increment</h1>

<p>Reload this page to increment the key 'number' in the session.</p>

<p>The current value is: <?= $app->session->get("number") ?></p>

<pre><?= var_dump($app->session) ?></pre>

<p>
    <a href="<?= url($mount."session") ?>">Back to session<a>
</p>
