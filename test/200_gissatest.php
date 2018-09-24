<?php

use Anax\Route\Router;

/**
 * Configuration file for routes.
 */
return [
    //"mode" => Router::DEVELOPMENT, // default, verbose execeptions
    //"mode" => Router::PRODUCTION,  // exceptions turn into 500

    // Path where to mount the routes, is added to each route path.
    "mount" => "gissa",

    // Load routes in order, start with these and the those found in
    // router/*.php.
    "routes" => [
                [
                    "info" => "Get test.",
                    "method" => "get",
                    "path" => "get",
                    "handler" => function () {
                        return "GET!";
                    },
                ],
                [
                    "info" => "POST test.",
                    "method" => "post",
                    "path" => "post",
                    "handler" => function () {
                        return "POST!";
                    },
                ],
                [
                    "info" => "GET+POST test.",
                    "method" => ["get", "post"],
                    "path" => "post",
                    "handler" => function () {
                        return "GET+POST!";
                    },
                ],
    ],
];
