<?php

$stmt = $db->prepare("SELECT balance FROM users WHERE telegram_id = ?");
$stmt->execute([$chat_id]);
$bal = $stmt->fetchColumn() ?: 0.0;

sendMessage($chat_id, "Your balance: {$bal}৳\nMinimum withdraw: 50৳");