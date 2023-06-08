<?php
include '../../db/connection.php';

$sql = "DELETE FROM hymns";
$delQuery = mysqli_query($con, $sql);
if ($delQuery == true) {
  $data = array(
    'status' => 'success',

  );

  echo json_encode($data);
} else {
  $data = array(
    'status' => 'failed',

  );

  echo json_encode($data);
}

header("Location: ../../index.php");
exit;
