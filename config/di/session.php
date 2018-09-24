<?php
/**
 * Creating the session as a $di service.
 */
return [
    // Services to add to the container.
    "services" => [
        "session" => [
            "active" => defined("ANAX_WITH_SESSION") && ANAX_WITH_SESSION, // true|false
            "shared" => true,
            "callback" => function () {
                // $session = new \Anax\Session\Session();
                $session = new \Anna\Guess\Session();

                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("session");

                // Set session name
                $name = $config["config"]["name"] ?? null;
                if (is_string($name)) {
                    // $session->name($name);
                    $session->setName($name);
                }

                $session->start();

                return $session;
            }
        ],
    ],
];
