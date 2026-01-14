<?php
// Auto-seed default tasks ONLY if table is empty (runs once)
$stmt = $db->query("SELECT COUNT(*) FROM tasks");
if ($stmt->fetchColumn() == 0) {
    $db->exec("INSERT INTO tasks (title, reward) VALUES
        ('Join our Telegram channel', 20.0),
        ('Follow us on X/Twitter', 15.0),
        ('Subscribe to YouTube channel', 25.0),
        ('Like & retweet pinned post', 30.0),
        ('Visit our website and register', 10.0)
    ");
    
    file_put_contents("debug.log", "Default tasks auto-seeded successfully\n", FILE_APPEND);
}