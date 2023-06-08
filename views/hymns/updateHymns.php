<?php
include '../../db/connection.php';

$cantor = $_POST['cantor'];
$cidade = $_POST['cidade'];
$pastor = $_POST['pastor'];
$third = $_POST['third'];
$titulo = $_POST['titulo'];
$id = $_POST['id'];

$sql = "UPDATE `hymns` SET  `cantor`= '$cantor',  `cidade`='$cidade', `pastor`='$pastor',  `third`='$third',  `titulo`='$titulo', `updated_at`=NOW() WHERE id='$id' ";
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
