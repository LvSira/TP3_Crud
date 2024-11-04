<?php
include 'conexion.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("SELECT * FROM Datos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $item = $resultado->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['Nombre'];
    $descripcion = $_POST['Descripcion'];
    $urlImagen = $_POST['ImagenUrl'];

    $stmt = $conexion->prepare("UPDATE Datos SET Nombre = ?, Descripcion = ?, Imagen = ? WHERE ID = ?");
    $stmt->bind_param("sssi", $nombre, $descripcion, $urlImagen, $id);
    $stmt->execute();

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Platos</title>
    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.form-container {
    width: 90%;
    max-width: 600px; 
    margin: 20px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
}

form label {
    margin: 10px 0 5px;
    font-weight: bold;
}

form input[type="text"],
form input[type="url"],
form textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

form input[type="submit"] {
    background: #5cb85c;
    color: #fff;
    border: none;
    padding: 10px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background 0.3s ease;
}

form input[type="submit"]:hover {
    background: #4cae4c;
}

form textarea {
    resize: vertical; 
}

    </style>
</head>
<body>
<div class="form-container">
        <h1>Actualizar Platos</h1>
        <form action="" method="post">
            <input type="hidden" name="ID" value="<?= $item['ID'] ?>">
            <label for="Nombre">Nombre:</label>
            <input type="text" name="Nombre" value="<?= htmlspecialchars($item['Nombre']) ?>" required>
            <label for="Descripcion">Descripción:</label>
            <textarea name="Descripcion" required><?= htmlspecialchars($item['Descripcion']) ?></textarea>
            <label for="ImagenUrl">URL de la Imagen:</label>
            <input type="url" name="ImagenUrl" value="<?= htmlspecialchars($item['Imagen']) ?>" required placeholder="Ingresa la URL de la imagen">
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>
</html>
