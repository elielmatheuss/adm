<?php 
include '../../db/connection.php';

$tipo = $_POST['tipo'];
$nome = $_POST['nome'];
$pastor = $_POST['pastor'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$pais = $_POST['pais'];
$nmr = $_POST['nmr'];
$id = $_POST['id'];

$sql = "UPDATE `audiencia` SET  `tipo`='$tipo' , `nome`= '$nome', `pastor`='$pastor',  `estado`='$estado',  `cidade`='$cidade',  `pais`='$pais',  `nmr`='$nmr' WHERE id='$id' ";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
   
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
}
