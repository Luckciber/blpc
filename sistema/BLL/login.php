<?php

require_once '../SERVICIOS/loginService.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $loginService = new LoginService($pdo);
    $validarUsuario = $loginService->login($usuario, $password);
    if ($validarUsuario) {
        var_dump($validarUsuario);
        $_SESSION['nombre_usuario'] = $validarUsuario['nombre_usuario'];
        header('Location: ../../dashboard.php');
        exit;
    } else {
        // echo "NO SE ENCONTRARON RESULTADOS ".$usuario." ".$password ;
        header('Location: ../../index.php');
    }
}

?>