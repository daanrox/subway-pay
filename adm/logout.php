<?php
session_start();

// Destruir a variável de sessão específica
unset($_SESSION['emailadm']);

// Redirecionar para a página desejada após destruir a variável de sessão
header("Location: login");
exit();
?>