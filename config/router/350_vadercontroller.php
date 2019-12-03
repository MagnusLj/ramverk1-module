<?php
/**
 * Load the IP Checker as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Väder.",
            "mount" => "vader",
            "handler" => "\Malm18\Vader\VaderController",
        ],
        [
            "info" => "JSON-väder.",
            "mount" => "json-vader",
            "handler" => "\Malm18\Vader\JsonVaderController",
        ],
    ]
];
