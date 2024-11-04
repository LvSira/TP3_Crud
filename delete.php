<?php
include 'conexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $stmt = $conexion->prepare("DELETE FROM Datos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    header("Location: index.php");
}
?>
