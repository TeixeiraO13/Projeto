<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Rubik+Bubbles&display=swap" rel="stylesheet">
</head>
<body>

    <div class="body">

    <form action="" method="post">

    <div class="cadastro-container">
        <div class="header">

            <a href="index.html" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
            <h2>Cadastro</h2>

        </div>

        <div class="name">
            <i class="fa-solid fa-user"></i>
            <input type="text" class="input-field" id="nomeCadastro" name="nomex"  placeholder="Nome" required>
        </div>

        <div class="email">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" class="input-field" id="email" name="emailx" placeholder="Email" required>
        </div>

        <div class="genero">
            <i class="fa-solid fa-venus-mars"></i>
            <select class="select-field" id="genero" name="generox" required>
                <option value="" disabled selected>Selecione o gênero</option>
                <option value="masculino" id="masculino">Masculino</option>
                <option value="feminino" id="feminino">Feminino</option>
            </select>
        </div>

        <div class="senha">
            <i class="fa-solid fa-lock"></i>
            <input type="password" class="input-field" name="senhax"placeholder="Senha" required>
        </div>

        <button type="submit" class="cadastro-button" name="enviarx" id="cadastro-btn">Cadastrar</button>
        
    </form>

        <div class="linkLogin">
            <a href="login.php" class="login-link">Já tem uma conta? <span class="login-link2"> Faça login </span></a>
        </div>
    </div>

    <div class="imgCadastro"><img src="assets/img/img-cadastro.svg" alt=""></div>

</div>

<script src="https://kit.fontawesome.com/a13d0d5b4e.js" crossorigin="anonymous"></script>
<script src="js/cadastro.js"></script>
</body>
</html>

<?php

    include "conexao.php";
    if (isset($_POST['enviarx'])):
    $nome=$_POST['nomex'];
    $email=$_POST['emailx'];
    $genero=$_POST['generox'];
    $senha=$_POST['senhax'];

    $sql=mysqli_query($conexao,
    "INSERT INTO `cadconta` (`id`,`nome`, `email`, `genero`, `senha`)
    VALUES(NULL,'$nome', '$email', '$genero', '$senha')"

    );
    endif;
    
?>

