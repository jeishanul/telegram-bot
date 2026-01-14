<?php
$db = new PDO("sqlite:database/bot.sqlite");
$db->exec("INSERT INTO tasks(title,reward) VALUES
('Join Telegram Channel',5),
('Visit Website',10)
");
