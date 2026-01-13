<?php

require "functions.php";
require "states.php";

$update = json_decode(file_get_contents("php://input"), true);
file_put_contents("debug.log", print_r($update, true), FILE_APPEND);

$chat_id = $update['message']['chat']['id'] ?? null;
$text = trim($update['message']['text'] ?? "");

if (!$chat_id)
    exit;

$state = getState($chat_id);

if ($text == "/start") {
    require "handlers/start.php";
    exit;
}

if ($text == "/tasks") {
    require "handlers/tasks.php";
    exit;
}

if (strpos($state, "proof") === 0) {
    require "handlers/proof.php";
    exit;
}

if($text == "/withdraw"){
   require "handlers/withdraw.php";
   exit;
}

require "handlers/buttons.php";
