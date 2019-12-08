<?php
/**
 * Configuration file for DI container.
 */
return [
    "services" => [
        "vader" => [
            "shared" => true,
            "callback" => function () {
                $vader = new \Malm18\Vader\VaderHandler();
                return $vader;
            },
        ],
    ],
];
