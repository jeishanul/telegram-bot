<?php
require "config.php";
require "db.php";
require "functions.php";

file_put_contents("debug.log", "=== Script started at " . date('Y-m-d H:i:s') . " ===\n", FILE_APPEND);

try {
    $raw = file_get_contents("php://input");
    file_put_contents("debug.log", "RAW: $raw\n", FILE_APPEND);

    $update = json_decode($raw, true);

    if (!$update || empty($update["message"])) {
        file_put_contents("debug.log", "No valid message update\n", FILE_APPEND);
        http_response_code(200);
        exit;
    }

    file_put_contents("debug.log", "Update decoded successfully\n", FILE_APPEND);

    require "router.php";

    file_put_contents("debug.log", "Update processed successfully\n", FILE_APPEND);

} catch (Throwable $e) {
    $error = "EXCEPTION: " . $e->getMessage() .
             " in " . $e->getFile() .
             " on line " . $e->getLine() .
             "\nTrace:\n" . $e->getTraceAsString() . "\n\n";
    file_put_contents("debug.log", $error, FILE_APPEND);
}

http_response_code(200);
