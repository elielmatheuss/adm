<?php
include '../../db/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedidos de Oração</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;800&display=swap" rel="stylesheet">
  <link href="../../assets/css/bootstrap5.0.1.min.css" rel="stylesheet">
</head>

<body>

  <div class="d-flex justify-content-center mb-5">
    <h1>Pedidos de Oração</h1>
  </div>
  <div class="m-4">
    <?php

    $sqlMotivoOracao = "SELECT DISTINCT motivo_oracao FROM oracao";
    $resMotivoOracao = mysqli_query($con, $sqlMotivoOracao);


    if (mysqli_num_rows($resMotivoOracao) > 0) {
      // Iterar sobre as categorias
      while ($rowMotivosOracao = mysqli_fetch_assoc($resMotivoOracao)) {


        $motivoOracao = $rowMotivosOracao['motivo_oracao'];

        $sqlOracao = "SELECT * FROM motivos_oracao WHERE id = '$motivoOracao'";
        $resMotivo = mysqli_query($con, $sqlOracao)->fetch_assoc();


        echo "<h2 class='mt-4'>" . $resMotivo["descricao"] . " </h2>";

        // Consulta para obter os dados da categoria atual
        $sqlOracao = "SELECT * FROM oracao WHERE motivo_oracao = '$motivoOracao'";
        $resOracao = mysqli_query($con, $sqlOracao);

        if (mysqli_num_rows($resOracao) > 0) {
          // Exibir os dados na tela
          while ($rowOracao = mysqli_fetch_assoc($resOracao)) {

            echo  $rowOracao["nome"] .  " -  " . $rowOracao["cidade"] .  $rowOracao["mens_dest"] . "<br>";
          }
        } else {
          echo "Nenhum resultado encontrado para a categoria '$categoria'.";
        }
      }
    } else {
      echo "Nenhuma categoria encontrada na tabela.";
    }

    mysqli_close($con);
    ?>
  </div>
</body>

</html>