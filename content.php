<?php
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
  // Redirecione para outra página
  header('Location: login.php');
  exit;
}
