<?php
session_start();

unset($_SESSION['emailadm']);

header("Location: login");
exit();
?>