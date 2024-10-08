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

require_once 'includes/config.php';

$sql = "SELECT * from produtos";
$resultado = $conn->query($sql);

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
        <a href="cadastroProduto.php">Cadastrar produto</a>
    </header>
    <main>
        <?php if($resultado->num_rows > 0) : ?>
        <?php while ($produto = $resultado->fetch_assoc()): ?>
            <div>
                <h3><?php echo $produto['nome'] ?></h3>
                <h3>Descrição:<?php echo $produto['descricao'] ?></h3> <!-- Verifique o nome da coluna -->
                <h3>Quantidade:<?php echo $produto['quantidade'] ?></h3>
                <button>Editar</button>
                <button>Excluir</button>
            </div>
        <?php endwhile ?>  
        <?php else: ?> 
        <p>Nenhum produto cadastrado.</p> 
        <?php endif; ?>  
        <?php $conn->close(); ?> 
    </main>
</body>
</html>
