<?php

require "db.php";
$result = $db->query("SELECT NOW() as now")->fetch();
echo "Connected! Server time: " . $result['now'];
