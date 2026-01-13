<?php

require "handlers/referral.php";

global $db;

$u = $update['message']['from'];

$db->prepare("INSERT IGNORE INTO users(telegram_id,username,first_name,last_name) VALUES(?,?,?,?)")
    ->execute([$u['id'], $u['username'], $u['first_name'], $u['last_name']]);

sendMessage(
    $chat_id,
    "🚀 Welcome!\n\nRegister here:\nhttps://gigclickers.com/register\n\nSend your registered email now."
);

setState($chat_id, STATE_EMAIL);
