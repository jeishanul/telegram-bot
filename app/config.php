<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function logg($text)
{
    file_put_contents(__DIR__ . "/debug.log", date("Y-m-d H:i:s") . " " . $text . "\n", FILE_APPEND);
}

$db_file = __DIR__ . "/database/database.sqlite";

try {
    $pdo = new PDO("sqlite:$db_file");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    logg("DB Connected OK");
} catch (Exception $e) {
    logg("DB ERROR: " . $e->getMessage());
    die("DB Error");
}

define("BOT_TOKEN", "YOUR_BOT_TOKEN");
define("API_URL", "https://api.telegram.org/bot" . BOT_TOKEN . "/");
