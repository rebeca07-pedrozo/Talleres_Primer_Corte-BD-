<?php 
session_start();
include('conexion.php');

if(isset($_POST['Usuario']) && isset($_POST['Clave'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $Usuario = validate($_POST['Usuario']);
    $Clave = validate($_POST['Clave']);

    if (empty($Usuario)) {
        header("Location: Index.php?error=El Usuario es Requerido");
        exit();
    } elseif (empty($Clave)) {
        header("Location: Index.php?error=La clave es Requerida");
        exit();
    } else {
        $Sql = "SELECT * FROM clientes WHERE nombre = '$Usuario' AND contrasena = '$Clave'"; 
        $result = mysqli_query($conexion, $Sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['nombre'] === $Usuario && $row['contrasena'] === $Clave) {
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['correo'] = $row['correo'];
                $_SESSION['id_cliente'] = $row['id_cliente'];
                header("Location: Inicio.php");
                exit();
            } else {
                header("Location: Index.php?error=El usuario o la clave son incorrectos");
                exit();
            }
        } else {
            header("Location: Index.php?error=El usuario o la clave son incorrectos");
            exit();
        }
    }
} else {
    header("Location: Index.php");
    exit();
}
?>
