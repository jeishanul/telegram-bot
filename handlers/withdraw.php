<?php

$state = getState($chat_id);

if ($state == STATE_NONE) {
    sendMessage(
        $chat_id,
        "💳 Select withdraw method:",
        [
            "keyboard" => [
                [["text" => "bKash"], ["text" => "Nagad"]],
                [["text" => "Cancel"]]
            ],
            "resize_keyboard" => true
        ]
    );
    setState($chat_id, STATE_WITHDRAW_METHOD);
    exit;
}

if ($state == STATE_WITHDRAW_METHOD) {
    setState($chat_id, "withdraw_method:$text");
    sendMessage($chat_id, "💰 Enter withdraw amount:");
    exit;
}

if (strpos($state, "withdraw_method") === 0) {
    setState($chat_id, $state . ":$text");
    sendMessage($chat_id, "📞 Enter your payment number:");
    exit;
}

if (strpos($state, "withdraw_method") !== false) {
    $data = explode(":", $state);
    $method = $data[1];
    $amount = $data[2];

    $db->prepare("INSERT INTO withdrawals(telegram_id,amount,method,number) VALUES(?,?,?,?)")
        ->execute([$chat_id, $amount, $method, $text]);

    sendMessage($chat_id, "✅ Withdrawal request submitted!");
    setState($chat_id, STATE_NONE);
}
