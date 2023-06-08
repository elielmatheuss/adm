<?php
require '../../db/connection.php';

//CONSULTA TABELA DE CIDADES

$result_estado = "SELECT * FROM estado";
$estados = mysqli_query($con, $result_estado)->fetch_all();
