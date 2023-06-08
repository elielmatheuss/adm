<?php
include '../../db/connection.php';

$nome = $_POST['url'];
$file = $_POST['file'];
$tipo = $_POST['tipo'];
$id = $_POST['id'];

$sql = "UPDATE `config_player` SET  `url`= '$url',  `file`='$file', `tipo`='$tipo' WHERE id='$id' ";
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
