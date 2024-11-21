<?php

require_once __DIR__ . '/../Model/init.php';
$user = new User();
$user->logout();

header("Location: login.php");
exit;
?>