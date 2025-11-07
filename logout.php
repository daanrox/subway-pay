<?php
session_start();

$_SESSION = array();

header("Location: index.php");
exit();
?>
