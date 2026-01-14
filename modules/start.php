<?php
$keyboard = [
    "keyboard" => [
        [["text" => "📋 Tasks"], ["text" => "💰 Withdraw"]],
        [["text" => "👥 Referral"]]
    ],
    "resize_keyboard" => true
];

file_put_contents("debug.log", "Start module loaded – sending welcome\n", FILE_APPEND);

sendMessage($chat_id, "Welcome to Gigclickers Task Bot!", $keyboard);
