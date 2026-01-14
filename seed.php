<?php
// seed.php
try {
    $db = new PDO('sqlite:' . __DIR__ . '/db/database.sqlite');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create table if not exists
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT,
        chat_id INTEGER
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS tasks (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        task TEXT,
        completed INTEGER DEFAULT 0
    )");

    // Insert some default users
    $db->exec("INSERT INTO users (username, chat_id) VALUES 
        ('Jeishanul', 2077162700),
        ('TestUser', 1234567890)
    ");

    echo "✅ Database seeded successfully!";
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
