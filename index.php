<?php
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
  // Redirecione para outra página
  header('Location: login.php');
  exit;
}

// Verificar se o usuário está logado
if (!isset($_SESSION["id"])) {
  // Redirecionar para a página de login se não estiver logado
  header("Location: login.php");
  exit;
}

// Obtém os dados do usuário da sessão
$id = $_SESSION["id"];
$nome = $_SESSION["nome"];
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
  <script src="/assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.112.5">
  <title>Sticky Footer Navbar Template · Bootstrap v5.3</title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sticky-footer-navbar/">
  <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">


  <?php include 'views/header.php'; ?>


  <footer class="footer mt-auto py-3 bg-body-tertiary">
    <div class="container">
      <span class="text-body-secondary">Manipulação de Tabelas - Igreja Evangélica Luz no Entardecer.</span>
    </div>
  </footer>
  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>