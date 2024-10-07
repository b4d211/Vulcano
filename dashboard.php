<?php

session_start();

//desconectar
if(isset($_GET['logout'])){
    session_unset();
    session_destroy();

    header("location: index.php");
    exit();

}
//verificar se tem usuario
if(!isset($_SESSION['usuario_id'])){
    header("location: index.php");
    exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <header>
        <a href="?logout=true">Sair</a>
    </header>
</body>
</html>