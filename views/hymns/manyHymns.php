<?php
include '../../db/connection.php';

$output = array();
// $sql = "SELECT * FROM oracao INNER JOIN motivos_oracao  ON oracao.motivo_oracao = motivos_oracao.id";
$sql = "SELECT * FROM hymns";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
  0 => 'id',
  1 => 'cantor',
  2 => 'cidade',
  3 => 'pastor',
  4 => 'third',
  5 => 'titulo',
  // 5 => 'descricao',
);

if (isset($_POST['search']['value'])) {
  $search_value = $_POST['search']['value'];
  $sql .= " WHERE pastor like '%" . $search_value . "%'";
  $sql .= " OR cidade like '%" . $search_value . "%'";
  $sql .= " OR third like '%" . $search_value . "%'";
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
  $sub_array[] = $row['cantor'];
  $sub_array[] = $row['cidade'];
  $sub_array[] = $row['pastor'];
  $sub_array[] = $row['third'];
  $sub_array[] = $row['titulo'];
  // $sub_array[] = $row['descricao'];
  $sub_array[] = '<a href="javascript:void();" data-id="' . $row['id'] . '"  class="btn btn-info btn-sm editbtn" >Edit</a>  <a href="javascript:void();" data-id="' . $row['id'] . '"  class="btn btn-danger btn-sm deleteBtn" >Delete</a>';
  $data[] = $sub_array;
}
$output = array(
  'draw' => intval($_POST['draw']),
  'recordsTotal' => $count_rows,
  'recordsFiltered' =>   $total_all_rows,
  'data' => $data,
);
echo  json_encode($output);
