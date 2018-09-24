<?php
/**
 * Config-file for sessions.
 */
return [
    // Session name
    // "name" => preg_replace("/[^a-z\d]/i", "", __DIR__),
    "name" => substr(preg_replace('/[^a-z\d]/i', '', __DIR__), -30),
    //"name" => preg_replace("/[^a-z\d]/i", "", ANAX_APP_PATH),
];
