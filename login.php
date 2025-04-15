<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<form action="" method="post">
<div class="login-container">

        <div class="header">

            <a href="index.html" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
            <h2>Login</h2>

        </div>

        <div class="name">
            <i class="fa-solid fa-user"></i>
            <input type="email" class="input-field" name="emailx" placeholder="Email" required>
        </div>

        <div class="senha">
            <i class="fa-solid fa-lock"></i>
            <input type="password" class="input-field" name="senhax" placeholder="Senha" required>
        </div>

        <button type="submit" class="login-button" name="enviarx" id="login-btn">Entrar</button>

    </form>
    
        <div class="linkRegister">
            <a href="cadastro.php" class="register-link">Ainda não tem uma conta? <span class="register-link2"> Cadastre-se</span></a>
        </div>

    </div>

    <div class="img-login">
        <img src="assets/img/img-login.svg" alt="">
    </div>



<script src="https://kit.fontawesome.com/a13d0d5b4e.js" crossorigin="anonymous"></script>    
<script src="js/login.js"></script>
</body>
</html>


<?php
session_start();
include "conexao.php";

if (isset($_POST['enviarx'])) {
    $email = $_POST['emailx'];
    $senha = $_POST['senhax'];

    $sql = "SELECT id, nome FROM cadconta WHERE email = '$email' AND senha = '$senha'";
    $resultado = mysqli_query($conexao, $sql);

    if ($resultado && mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['usuario_nome'] = $usuario['nome'];

        header("Location: paginaprincipal.php"); 
        exit();
        
    } else {
        $erro = "Email ou senha incorretos.";
        echo "<p style='color: red; text-align: center;'>$erro</p>";
    }

    mysqli_close($conexao);
}
?>