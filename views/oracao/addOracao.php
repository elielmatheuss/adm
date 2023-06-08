<?php

include '../../db/connection.php';

$nome           = strtolower(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
$stateCode      = strtolower(filter_input(INPUT_POST, 'stateCode', FILTER_SANITIZE_STRING));
$cityCode       = strtolower(filter_input(INPUT_POST, 'cityCode', FILTER_SANITIZE_STRING));
$motivo         = strtolower(filter_input(INPUT_POST, 'motivo', FILTER_SANITIZE_STRING));
$mens_dest       = strtolower( filter_input(INPUT_POST, 'request', FILTER_SANITIZE_STRING));

function convertem($term, $tp)
{

  if ($tp == "1")
    $palavra = strtr(strtoupper($term), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

  elseif ($tp == "0")
    $palavra = strtr(strtolower($term), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß", "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");

  return $palavra;
}

$nomestr = convertem($nome, 1);
$cityCodestr = convertem($cityCode, 1);
$mens_deststr = convertem($mens_dest, 1);

$sql_oracao = "INSERT INTO oracao(nome, cidade, estado, motivo_oracao, data, mens_dest) VALUES ('$nomestr', '$cityCodestr', '$stateCode', '$motivo', NOW(), '$mens_deststr')";
$result_sql_oracao = mysqli_query($con, $sql_oracao);

if (mysqli_insert_id($con)) {
  echo true;
} else {
  echo false;
}

//var_dump($query_oracao);
