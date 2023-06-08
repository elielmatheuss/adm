<?php
include '../../db/connection.php';


$type           = filter_input(INPUT_POST, 'typeNotification', FILTER_SANITIZE_STRING);
$name           = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$minister       = filter_input(INPUT_POST, 'minister', FILTER_SANITIZE_STRING);
$stateCode      = filter_input(INPUT_POST, 'stateCode', FILTER_SANITIZE_STRING);
$cityIrmaosCode = filter_input(INPUT_POST, 'cityIrmaosCode', FILTER_SANITIZE_STRING);
$cityName       = filter_input(INPUT_POST, 'cityName', FILTER_SANITIZE_STRING);
$countryCode    = filter_input(INPUT_POST, 'countryCode', FILTER_SANITIZE_STRING);
$numberBrothers = filter_input(INPUT_POST, 'numberBrothers', FILTER_SANITIZE_STRING);

function convertem($term, $tp)
{

  if ($tp == "1")
    $palavra = strtr(strtoupper($term), "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß");

  elseif ($tp == "0")
    $palavra = strtr(strtolower($term), "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÜÚÞß", "àáâãäåæçèéêëìíîïðñòóôõö÷øùüúþÿ");

  return $palavra;
}

$namestr           = convertem($name, 1);
$ministerstr       = convertem($minister, 1);
$cityIrmaosCodestr = convertem($cityIrmaosCode, 1);
$cityNamestr       = convertem($cityName, 1);
$countryCodestr    = convertem($countryCode, 1);



if (($type) == '3') {
  $sql_audiencia = "INSERT INTO audiencia(tipo, nome, cidade, pais, nmr, data) VALUES ('$type','$namestr', '$cityNamestr', '$countryCodestr', '$numberBrothers', NOW())";
  $result_sql_audiencia = mysqli_query($con, $sql_audiencia);
} else {
  $sql_audiencia = "INSERT INTO audiencia(tipo, nome, pastor, estado, cidade, nmr, data) VALUES ('$type','$namestr','$ministerstr', '$stateCode', '$cityIrmaosCodestr', '$numberBrothers', NOW())";
  $result_sql_audiencia = mysqli_query($con, $sql_audiencia);
}



if (mysqli_insert_id($con)) {
  echo true;
} else {
  echo false;
}

//var_dump($type);
