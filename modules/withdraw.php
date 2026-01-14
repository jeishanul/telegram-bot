<?php
$bal = $db->query("SELECT balance FROM users WHERE telegram_id=$chat_id")->fetchColumn();
sendMessage($chat_id, "Your balance: $bal ৳\nMinimum withdraw: 50৳");
