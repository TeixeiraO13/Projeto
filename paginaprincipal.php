<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit();
}

include "conexao.php";

$usuario_id = $_SESSION['usuario_id'];
$sql_usuario = "SELECT nome FROM cadconta WHERE id = $usuario_id";
$resultado_usuario = mysqli_query($conexao, $sql_usuario);

if ($resultado_usuario && mysqli_num_rows($resultado_usuario) == 1) {
    $usuario_nome = mysqli_fetch_assoc($resultado_usuario)['nome'];
} else {
    $usuario_nome = "Usuário"; // Valor padrão em caso de erro
}

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeTool</title>
    <link rel="stylesheet" href="css/paginaprincipal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">LifeTool</div>
            <div class="navbar-user">
                <i class="fa-solid fa-user"></i>
                <span><?php echo htmlspecialchars($usuario_nome); ?></span>
            </div>
        </div>
    </nav>

    <div class="sidebar">
        <div class="user-info">
            <i class="fa-solid fa-circle-user"></i>
            <p><?php echo htmlspecialchars($usuario_nome); ?></p>
        </div>
        <ul class="menu">
            <li><a href="#"><i class="fa-solid fa-wallet"></i> Financeiro</a></li>
            <li><a href="#"><i class="fa-solid fa-heart-pulse"></i> Saúde</a></li>
            <li><a href="#"><i class="fa-solid fa-calendar-days"></i> Agenda</a></li>
            <li><a href="#"><i class="fa-solid fa-briefcase"></i> Trabalho</a></li>
            <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
        </ul>
    </div>

    <div class="content">
        <h1>Bem-vindo(a), <?php echo htmlspecialchars($usuario_nome); ?>!</h1>
        <p>Seu espaço para organizar sua vida.</p>
    </div>

    <script src="js/principal.js"></script>
</body>
</html>