<?php
include("db/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $contrasena = $_POST['contrasena'];

    $sql = "INSERT INTO clientes (nombre, correo, telefono, contrasena) VALUES ('$nombre', '$correo', '$telefono', '$contrasena')";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado) {
        header("Location: index.php?mensaje=Cuenta creada correctamente");
    } else {
        header("Location: CrearCuenta.php?error=Error al registrar usuario");
    }
}
?>
