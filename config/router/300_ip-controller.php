<?php
/**
 * Load the IP Checker as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "IP Checker.",
            "mount" => "ip-checker",
            "handler" => "\Malm18\IPChecker\IPController",
        ],
        [
            "info" => "IP json Checker.",
            "mount" => "ip-json-checker",
            "handler" => "\Malm18\IPChecker\IPJsonController",
        ],
    ]
];
