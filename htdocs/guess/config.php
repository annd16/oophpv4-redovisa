<?php
/**
 * Set the error reporting.
 */
error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors


/**
 * Default exception handler.
 */
set_exception_handler(function ($e) {
    echo "<p>Anax: Uncaught exception:</p><p>Line "
        . $e->getLine()     // Exception::getLine — Gets the line in which the exception was created
        . " in file "
        . $e->getFile()     // Exception::getFile — Gets the file in which the exception was created
        . "</p><p><code>"
        . get_class($e)         // get_class — Returns the name of the class of an object
        . "</code></p><p>"
        . $e->getMessage()      // Exception::getMessage — Gets the Exception message
        . "</p><p>Code: "
        . $e->getCode()       // Exception::getCode — Gets the Exception code
        . "</p><pre>"
        . $e->getTraceAsString()     // Exception::getTraceAsString — Gets the stack trace as a string
        . "</pre>";
});
