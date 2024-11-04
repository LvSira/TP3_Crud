<?php
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'insertar') {
    $nombre = $_POST['Nombre'];
    $descripcion = $_POST['Descripcion'];
    $imagenUrl = $_POST['ImagenUrl'];

    $stmt = $conexion->prepare("INSERT INTO Datos (Nombre, Descripcion, Imagen) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $descripcion, $imagenUrl);
    $stmt->execute();
}

if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar') {
    $id = $_GET['id'];
    $stmt = $conexion->prepare("DELETE FROM Datos WHERE ID = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

$stmt = $conexion->query("SELECT * FROM Datos");
$datos = $stmt->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>LISTA DE Animes</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            border-radius: 5px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="form-container">
        <h1>Agregar Nuevo Anime</h1>
        <form action="" method="post">
            <input type="hidden" name="accion" value="insertar">
            <label for="Nombre">Nombre:</label>
            <input type="text" name="Nombre" required>
            <label for="Descripcion">Descripción:</label>
            <textarea name="Descripcion" required></textarea>
            <label for="ImagenUrl">URL de la Imagen:</label>
            <input type="url" name="ImagenUrl" required placeholder="Ingresa la URL de la imagen">
            <input type="submit" value="Agregar Registro">
        </form>
    </div>

    <div class="form-container">
        <h1>Lista de Animes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['ID']) ?></td>
                    <td><?= htmlspecialchars($row['Nombre']) ?></td>
                    <td><?= htmlspecialchars($row['Descripcion']) ?></td>
                    <td><img src="<?= htmlspecialchars($row['Imagen']) ?>" alt="Imagen de <?= htmlspecialchars($row['Nombre']) ?>" /></td>
                    <td>
                        <a href="update.php?id=<?= $row['ID'] ?>">Actualizar</a>
                        <a href="?accion=eliminar&id=<?= $row['ID'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este anime?')">Eliminar</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
