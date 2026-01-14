<?php
$chat_id = $update["message"]["chat"]["id"];
$text = trim($update["message"]["text"] ?? "");

file_put_contents("debug.log", "Processing → chat_id: $chat_id | text: '$text'\n", FILE_APPEND);

$stmt = $db->prepare("INSERT OR IGNORE INTO users(telegram_id) VALUES(?)");
$stmt->execute([$chat_id]);
file_put_contents("debug.log", "User inserted/ignored\n", FILE_APPEND);

// Handle /start (with or without referral payload)
if (strpos($text, "/start") === 0) {
    file_put_contents("debug.log", "Handling /start command\n", FILE_APPEND);

    $parts = explode(" ", $text);
    $payload = $parts[1] ?? null;

    if ($payload && is_numeric($payload) && $payload != $chat_id) {
        $stmt = $db->prepare("UPDATE users SET ref_by = ? WHERE telegram_id = ? AND ref_by IS NULL");
        $stmt->execute([$payload, $chat_id]);
        file_put_contents("debug.log", "Referral applied: referred by $payload\n", FILE_APPEND);
    }

    require "modules/start.php";
}
// rest of your conditions...
elseif (stripos($text, "submit") === 0) {  // case-insensitive
    file_put_contents("debug.log", "Handling submit\n", FILE_APPEND);
    require "modules/submit.php";
} elseif ($text == "📋 Tasks") {
    require "modules/tasks.php";
} elseif ($text == "💰 Withdraw") {
    require "modules/withdraw.php";
} elseif ($text == "👥 Referral") {
    require "modules/referral.php";
} else {
    sendMessage($chat_id, "Use the menu 👇");
}
