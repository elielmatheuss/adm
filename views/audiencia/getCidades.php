<?php
require '../../db/connection.php';

//CONSULTA TABELA DE CIDADES

$result_cidade = "SELECT * FROM cidade WHERE uf='" . $_POST['id'] . "'";
$resultado_cidade = mysqli_query($con, $result_cidade);
while ($row_estado = mysqli_fetch_assoc($resultado_cidade))

  echo '<option>' . $row_estado['nome'] . '</option>';
