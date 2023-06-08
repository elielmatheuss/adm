<?php
include '../../db/connection.php';

$nome = $_POST['nome'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$mens_dest = $_POST['mens_dest'];
$motivo_oracao = $_POST['motivo_oracao'];
$id = $_POST['id'];

$sql = "UPDATE `oracao` SET  `nome`= '$nome',  `estado`='$estado', `cidade`='$cidade',  `mens_dest`='$mens_dest',  `motivo_oracao`='$motivo_oracao' WHERE id='$id' ";
$query = mysqli_query($con, $sql);
$lastId = mysqli_insert_id($con);
if ($query == true) {

  $data = array(
    'status' => 'true',

  );

  echo json_encode($data);
} else {
  $data = array(
    'status' => 'false',

  );

  echo json_encode($data);
}
