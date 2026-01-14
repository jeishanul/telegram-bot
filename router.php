<?php
$chat_id = $update["message"]["chat"]["id"];
$text = trim($update["message"]["text"] ?? "");

$stmt = $db->prepare("INSERT OR IGNORE INTO users(telegram_id) VALUES(?)");
$stmt->execute([$chat_id]);

if ($text == "/start") {
    require "modules/start.php";
} elseif ($text == "📋 Tasks") {
    require "modules/tasks.php";
} elseif ($text == "💰 Withdraw") {
    require "modules/withdraw.php";
} elseif ($text == "👥 Referral") {
    require "modules/referral.php";
}elseif (str_starts_with($text, "submit")) {
    require "modules/submit.php";
} else {
    sendMessage($chat_id, "Use menu 👇");
}
