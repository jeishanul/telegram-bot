<?php
require "config.php";
require "db.php";

$count = $db->query("SELECT COUNT(*) FROM tasks")->fetchColumn();
if ($count > 0) {
    echo "Tasks already exist ($count). Skipping seed.\n";
    exit;
}

$db->exec("INSERT INTO tasks (title, reward) VALUES
    ('Join our Telegram channel', 20),
    ('Follow us on X/Twitter', 15),
    ('Subscribe to YouTube channel', 25),
    ('Like & retweet pinned post', 30),
    ('Visit our website', 10)
");

echo "✅ Tasks seeded successfully!\n";