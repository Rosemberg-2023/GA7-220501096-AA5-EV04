<?php
global $pdo, $URL;
include ('../../config.php');

$nombres = $_POST['nombres'];
$email = $_POST['email'];
//$rol = $_POST['rol'];
$password_user = $_POST['password_user'];
$password_repeat = $_POST['password_repeat'];
//validamos si los datos de la contrase;as ingresados son correctos para ingresar los datos en la base de datos
if($password_user == $password_repeat) {
    $password_user = password_hash($password_user, PASSWORD_DEFAULT);
    $sentencia = $pdo->prepare("INSERT INTO tb_usuarios
        ( nombres, email, password_user, fyh_creacion)
VALUES  (:nombres,:email,:password_user, :fyh_creacion)");

    $sentencia->bindParam('nombres',$nombres);
    $sentencia->bindParam('email',$email);
    //pendiente por codificar los roles de los usuarios del sistemas
    /*$sentencia->bindParam('id_rol',$rol);*/
    $sentencia->bindParam('password_user',$password_user);
    $sentencia->bindParam('fyh_creacion',$fechaHora);
    $sentencia->execute();
    session_start();
    $_SESSION['mensaje'] = "Se registro al usuario de la manera correcta";
    header('Location: '.$URL.'/usuarios/');

}else
{
//    echo "error las contraseñas no son iguales";
    session_start();
    $_SESSION['mensaje'] = "Error Contraseña no son iguales";
    header('Location: '.$URL.'/usuarios/crear_usuarios.php');
}

