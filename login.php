<?php
include 'db/connection.php';
session_start();

$_SESSION['loggedIn'] = true;

// Verificar se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Obter as credenciais do formulário
  $email = $_POST["email"];
  $senha = $_POST["senha"];

  // Conectar ao banco de dados


  // Consultar o banco de dados para verificar as credenciais do usuário
  $query = "SELECT id, name FROM users WHERE email = '$email' AND password = '$senha'";
  $resultado = mysqli_query($con, $query);

  // Verificar se encontrou um usuário com as credenciais fornecidas
  if (mysqli_num_rows($resultado) == 1) {
    // Iniciar a sessão e armazenar os dados do usuário logado
    $usuario = mysqli_fetch_assoc($resultado);
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["nome"] = $usuario["nome"];

    // Redirecionar para a página de perfil do usuário
    header("Location: index.php");
    exit;
  } else {
    // Exibir uma mensagem de erro se as credenciais forem inválidas
    $erro = "Credenciais inválidas. Tente novamente.";
  }

  // Fechar a conexão com o banco de dados
  mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Material Design for Bootstrap</title>
  <!-- MDB icon -->
  <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="assets/css/bootstrap-login-form.min.css" />
</head>

<body>
  <!-- Start your project here-->
  <style>
    .gradient-custom {
      /* fallback for old browsers */
      background: #6a11cb;

      /* Chrome 10-25, Safari 5.1-6 */
      background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

      /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
      background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
    }
  </style>
  <section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <div class="mb-md-5 mt-md-4 pb-5">

                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                <p class="text-white-50 mb-5">Por favor informe seu login e senha!</p>
                <form method="post" action="">
                  <div class="form-outline form-white mb-4">
                    <input type="email" id="email" class="form-control form-control-lg" name="email" />
                    <label class="form-label" for="typeEmailX">Email</label>
                  </div>

                  <div class="form-outline form-white mb-4">
                    <input type="password" id="senha" class="form-control form-control-lg" name="senha" />
                    <label class="form-label" for="senha">Password</label>
                  </div>


                  <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                </form>

              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End your project here-->

  <!-- MDB -->
  <script type="text/javascript" src="assets/js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript"></script>
</body>

</html>