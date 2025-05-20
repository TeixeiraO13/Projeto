<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include "conexao.php";

$usuario_id = $_SESSION['usuario_id'];
$sql_usuario = "SELECT nome, email FROM cadconta WHERE id = $usuario_id";
$resultado_usuario = mysqli_query($conexao, $sql_usuario);

if ($resultado_usuario && mysqli_num_rows($resultado_usuario) == 1) {
    $usuario = mysqli_fetch_assoc($resultado_usuario);
    $usuario_nome = $usuario['nome'];
    $usuario_email = $usuario['email'];
} else {
    $usuario_nome = "Usuário";
    $usuario_email = "desconhecido@exemplo.com";
}

// Fecha a conexão com o banco de dados, pois ela não é mais necessária depois de pegar os dados do usuário
mysqli_close($conexao);

// Verifica se foi passado o parâmetro 'secao' na URL (ex: ?secao=conta)
// Se foi, atribui o valor dele à variável $secao
// Se não foi, define 'conta' como valor padrão
$secao = isset($_GET['secao']) ? $_GET['secao'] : 'conta';

// Cria uma lista de seções válidas. Esses nomes devem corresponder aos arquivos que existem na pasta 'seções/'
// Isso é uma proteção simples pra evitar que alguém tente carregar um arquivo aleatório do servidor via URL
$secoes_validas = ['conta', 'financeiro', 'saude', 'agenda', 'trabalho'];

// Verifica se o valor de $secao está dentro da lista de seções válidas
// Se não estiver, define 'conta' como padrão (evita erro ou acesso a arquivos indevidos)
if (!in_array($secao, $secoes_validas)) {
    $secao = 'conta';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/paginaprincipal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
<div class="sideBar">

    <div class="header">

    <button class="buttonUser">

        <i class="fa-solid fa-user"></i>
        <span><?php echo htmlspecialchars($usuario_nome); ?></span>
        <i class="fa-solid fa-angle-down"></i>

    </button>

    <div class="buttonHeader">
        <i id='fechaSideBar' class="fa-solid fa-down-left-and-up-right-to-center"></i>
    </div>

    <div class="popUpUser">

    </div>

    </div>

    <div class="sectionLink">

     <a href="?secao=conta" class="menu-link <?php if($secao == 'conta') echo 'active-link'; ?>">
        <i class="fa-solid fa-user"></i> Conta
    </a>

    <a href="?secao=financeiro" class="menu-link <?php if($secao == 'financeiro') echo 'active-link'; ?>">
            <i class="fa-solid fa-wallet"></i> Financeiro
    </a>

    <a href="?secao=saude" class="menu-link <?php if($secao == 'saude') echo 'active-link'; ?>">
            <i class="fa-solid fa-heart-pulse"></i> Saúde
    </a>

    <a href="?secao=agenda" class="menu-link <?php if($secao == 'agenda') echo 'active-link'; ?>">
            <i class="fa-solid fa-calendar-days"></i> Agenda
    </a>

    <a href="?secao=trabalho" class="menu-link <?php if($secao == 'trabalho') echo 'active-link'; ?>">
            <i class="fa-solid fa-briefcase"></i> Trabalho
    </a>

    <a href="index.html"><i class="fa-solid fa-right-from-bracket"></i> Sair
    </a>

    </div>

    <div class="footer">

    </div>

</div>

    <div class='section'>

        <div class="sectionContent">
            <?php include "$secao.php"; ?>
        </div>
    </div>

    <script src="js/paginaInicial.js"></script>
</body>
</html>