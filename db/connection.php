<?php
$con  = mysqli_connect(
  'localhost',
  'root',
  '',
  'wwwtabe_jau'
);
if (mysqli_connect_errno()) {
  echo 'Não foi possível se conectar a base de dados!!!';
}
