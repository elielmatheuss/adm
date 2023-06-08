<?php
session_start();

session_unset();
// Destruir a sessão atual
session_destroy();

// Redirecionar para a página de login
header("Location: login.php");
exit;
