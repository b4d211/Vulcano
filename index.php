<?php
session_start();
 
require_once 'includes/config.php';
 
$mensagem_erro = "";
 
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];
 
  $sql_verifica = "SELECT * FROM usuarios WHERE email = ?";
  $stmt_verifica = $conn->prepare($sql_verifica);
  $stmt_verifica->bind_param('s', $email);
  $stmt_verifica->execute();
  $resultado = $stmt_verifica->get_result();
  $usuario = $resultado->fetch_assoc();
 
  if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    header("Location: dashboard.php");
    exit();
  } else {
    $mensagem_erro = "Email ou senha incorretos.";
  }
 
  $stmt_verifica->close();
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">

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
    <h1>Bem vindo de volta!</h1>
  </div>

    <h3>Entrar</h3>
  </div>

  <div class="loginBack">
    <form action="" method="POST">
      <h2>Login</h2>
      <h3>Preencha os campos abaixo com suas informaçoes</h3>
      <div class="conta">
      <label for="email">Email:</label>
      <input type="text" id="email" name="email" required> <br>
      </div>
      <div class="conta">
      <label for="senha">Senha:</label>
      <input type="password" id="senha" name="senha" required><br>
      </div>

      
  <?php if($mensagem_erro): ?>
  <p><?php echo $mensagem_erro; ?></p>
  <?php endif; ?>

  
      <input class="botao" type="submit" value="entrar">
      <p>Ja tem conta? <a href="cadastro.php">Ir para Cadastro</a></p>
    </form>
  </div>
</body>
</html>