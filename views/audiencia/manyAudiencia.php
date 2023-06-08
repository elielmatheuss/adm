<?php
include '../../db/connection.php';

$output = array();
$sql = "SELECT * FROM audiencia ";

$totalQuery = mysqli_query($con, $sql);
$total_all_rows = mysqli_num_rows($totalQuery);

$columns = array(
  0 => 'id',
  1 => 'tipo',
  2 => 'nome',
  3 => 'pastor',
  4 => 'estado',
  5 => 'cidade',
  6 => 'pais'
);

if (isset($_POST['search']['value'])) {
  $search_value = $_POST['search']['value'];
  $sql .= " WHERE nome like '%" . $search_value . "%'";
  $sql .= " OR pastor like '%" . $search_value . "%'";
  $sql .= " OR cidade like '%" . $search_value . "%'";
  $sql .= " OR tipo like '%" . $search_value . "%'";
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
  $sub_array[] = $row['tipo'];
  $sub_array[] = $row['nome'];
  $sub_array[] = $row['pastor'];
  $sub_array[] = $row['estado'];
  $sub_array[] = $row['cidade'];
  $sub_array[] = $row['pais'];
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
