<?php
session_start();
if(!isset($_SESSION['usuario_id'])){
  header("location: index.php");
  exit();

}

require_once 'includes/config.php';

$mensagem_sucesso= "";
$mensagem_erro= "";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $quantidade = intval($_POST['quantidade']);


  $sql_verifica = "SELECT * FROM produtos WHERE nome = ?";
  $stmt_verifica = $conn->prepare($sql_verifica);
  $stmt_verifica->bind_param('s', $nome);
  $stmt_verifica->execute();
  $resultado = $stmt_verifica->get_result();


  if ($resultado->num_rows > 0) {
    $mensagem_erro = "Este produto ja esta cadastrado.";
  } else {
    $sql = "INSERT INTO produtos (nome, descricao, quantidade) Values (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $nome, $descricao, $quantidade);


    if ($stmt->execute()) {
      $_SESSION['mensagem_sucesso'] = "Cadastro realizado com sucesso";
      header("Location: cadastroProduto.php");
      exit();
    } else {
      $mensagem_erro = "Erro ao cadastrar" . $conn->error;
    }
  }
  $stmt->close();
  $conn->close();
}


?>


<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

  <link rel="stylesheet" href="css/cadastrar.css">
  
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kodchasan:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

</head>


<body>
<div class="conteudo">
<div class="logo">
  <img src="imgs/Logo vulcano.png" alt=""> <h1>Vulcano</h1>
  </div>
<div class="texto">
    <h1>Seja bem vindo!</h1>
  </div>

    <h3>Entrar</h3>
  </div>
  <div class="cadastroback">
    <form action="" method="POST">
      <h2>Cadastro de Produto</h2>
      <h3>Preencha os campos abaixo:</h3>
      <label for="nome">Nome:</label>
      <input type="text" id="nome" name="nome" required><br>
      <label for="descricao">Descrição:</label>
      <input type="text" id="descricao" name="descricao" required><br>
      <label for="quantidade">Quantidade:</label>
      <input type="text" id="quantidade" name="quantidade" required><br>

  <?php if($mensagem_sucesso): ?>
  <p><?php echo $mensagem_sucesso; ?></p>
  <?php endif; ?>
  
  <?php if($mensagem_erro): ?>
  <p><?php echo $mensagem_erro; ?></p>
  <?php endif; ?>

      <input class="botao"type="submit" value="Cadastrar">
      <a href="dashboard.php">Ir para dashboard</a>
    </form>
  </div>
  </div>
</body>


</html>

