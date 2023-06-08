<?php

include '../../db/connection.php';


$cantor           = strtolower(filter_input(INPUT_POST, 'hymnsCantor', FILTER_SANITIZE_STRING));
$cidade      = strtolower(filter_input(INPUT_POST, 'hymnsCidade', FILTER_SANITIZE_STRING));
$pastor       = strtolower(filter_input(INPUT_POST, 'hymnsPastor', FILTER_SANITIZE_STRING));
$third         = strtolower(filter_input(INPUT_POST, 'hymnsThird', FILTER_SANITIZE_STRING));
$titulo       = strtolower(filter_input(INPUT_POST, 'hymnsTitulo', FILTER_SANITIZE_STRING));

function convertem($term, $tp)
{

  if ($tp == "1")
    $palavra = strtr(strtoupper($term), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

  elseif ($tp == "0")
    $palavra = strtr(strtolower($term), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß", "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");

  return $palavra;
}

$cantorstr = convertem($cantor, 1);
$cidadestr = convertem($cidade, 1);
$pastorstr = convertem($pastor, 1);
$thirdststr = convertem($third, 1);
$tituloststr = convertem($titulo, 1);

$sql_oracao = "INSERT INTO hymns (cantor, cidade, pastor, third, titulo, created_at) 
VALUES ('$cantorstr', '$cidadestr', '$pastorstr', '$thirdststr', '$tituloststr', NOW())";

$result_sql_oracao = mysqli_query($con, $sql_oracao);

if (mysqli_insert_id($con)) {
  echo true;
} else {
  echo false;
}

//var_dump($query_oracao);
