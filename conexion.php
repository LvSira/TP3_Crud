<?php
$servidor = 'mysql-sira.alwaysdata.net';
$usuario = 'sira';
$contrasena = 'mysql_crudpass_0415';
$bd = 'sira_crud';


$conexion = new mysqli($servidor, $usuario, $contrasena, $bd);

if ($conexion->connect_error){
    die($conexion->connect_error);
}
?>