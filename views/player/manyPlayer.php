<?php
include '../../db/connection.php';


$output = array();
// $sql = "SELECT * FROM oracao INNER JOIN motivos_oracao  ON oracao.motivo_oracao = motivos_oracao.id";
$sql = "SELECT * FROM config_player";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
  0 => 'id',
  1 => 'url',
  2 => 'file',
  3 => 'tipo',
  // 5 => 'descricao',
);

if (isset($_POST['search']['value'])) {
  $search_value = $_POST['search']['value'];
  $sql .= " WHERE url like '%" . $search_value . "%'";
  $sql .= " OR tipo like '%" . $search_value . "%'";
  $sql .= " OR file like '%" . $search_value . "%'";
}

if (isset($_POST['order'])) {
  $column_name = $_POST['order'][0]['column'];
  $order = $_POST['order'][0]['dir'];
  $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . "";
} else {
  $sql .= " ORDER BY id desc";
}

if ($_POST['length'] != -1) {
  $start = $_POST['start'];
  $length = $_POST['length'];
  $sql .= " LIMIT  " . $start . ", " . $length;
}

$query = mysqli_query($con, $sql);
$count_rows = mysqli_num_rows($query);
$data = array();
while ($row = mysqli_fetch_assoc($query)) {
  $sub_array = array();
  $sub_array[] = $row['id'];
  $sub_array[] = $row['url'];
  $sub_array[] = $row['file'];
  $sub_array[] = $row['tipo'];
  // $sub_array[] = $row['descricao'];
  $sub_array[] = '<a href="javascript:void();" data-id="' . $row['id'] . '"  class="btn btn-info btn-md editbtn" >Edit</a> ';
  $data[] = $sub_array;
}
$output = array(
  'draw' => intval($_POST['draw']),
  'recordsTotal' => $count_rows,
  'recordsFiltered' =>   $total_all_rows,
  'data' => $data,
);
echo  json_encode($output);
