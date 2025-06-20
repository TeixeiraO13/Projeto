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
    <link rel="stylesheet" href="css/paginaPrincipal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    
<nav id="sidebar" class= 'open-sidebar'>
        <div id="sidebar_content">
            <div class='user' id="user">
                <img class='user' src="avatar.jpg" id="user_avatar" alt="#">
    
                <p class='user' id="user_infos">
                    <span class="item-descriptio" style='font-size: 20px; color: #f1efec; display: flex; gap:20px'>
                    <?php echo htmlspecialchars($usuario_nome); ?>
                    <i class="fa-solid fa-angle-down" style ='color: #f1efec'></i>
                </span>
                </p>
            </div>

            <div id="popupAcount" class='popupAcountClosed'>
                <a href="configuracoes.php"><i class="fa-solid fa-gear"></i>Configurações</a>
                <a href="index.html"><i class="fa-solid fa-right-from-bracket"></i>Sair</a>
            </div>
    
            <ul id="side_items">
    
                <li class="side-item">
                <a href="?secao=financeiro" class="menu-link <?php if($secao == 'financeiro') echo 'active-link'; ?>"><i class="fa-solid fa-wallet"></i>
                <span class="item-description">
                        Financeiro
                </span>
                </a>
                </li>
    
                <li class="side-item">
                <a href="?secao=saude" class="menu-link <?php if($secao == 'saude') echo 'active-link'; ?>"><i class="fa-solid fa-heart-pulse"></i>
                    <span class="item-description">
                            Saúde
                    </span>
                </a>
                </li>
    
                <li class="side-item">
                <a href="?secao=agenda" class="menu-link <?php if($secao == 'agenda') echo 'active-link'; ?>"><i class="fa-solid fa-calendar-days"></i>
                    <span class="item-description">
                            Agenda
                    </span>
                </a>
                </li>
    
                <li class="side-item">
                <a href="?secao=trabalho" class="menu-link <?php if($secao == 'trabalho') echo 'active-link'; ?>"><i class="fa-solid fa-briefcase"></i>
                    <span class="item-description">
                            Trabalho
                    </span>
                </a>
                </li>
    
            </ul>
    
            <button id="open_btn" class='openButton'>
                <i id="open_btn_icon" class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

    </nav>


    <div class="section">
        <div class="sectionContent">
            <?php include "$secao.php"; ?>
        </div>
    </div>


    <script src="js/paginaPrincipal.js"></script>
</body>
</html>