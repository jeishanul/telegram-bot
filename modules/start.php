<?php
$keyboard = [
    "keyboard" => [
        [["text"=>"📋 Tasks"], ["text"=>"💰 Withdraw"]],
        [["text"=>"👥 Referral"]]
    ],
    "resize_keyboard" => true
];

sendMessage($chat_id, "Welcome to Gigclickers Task Bot!", $keyboard);
