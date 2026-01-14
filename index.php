<?php
require "config.php";
require "db.php";
require "functions.php";

$raw = file_get_contents("php://input");
file_put_contents("debug.log", "RAW: $raw\n", FILE_APPEND);

$update = json_decode($raw, true);
if (!$update || !isset($update["message"])) exit;

require "router.php";
