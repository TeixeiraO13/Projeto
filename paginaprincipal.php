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

mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeTool - Página Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/paginaprincipal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <div class="sidebar">
        <div class="text-center mb-4">
            <i class="fa-solid fa-user-circle fa-3x"></i>
            <p class="mt-2"><?php echo htmlspecialchars($usuario_nome); ?></p>
        </div>
        
        <a href="#" class="menu-link active-link" data-section="conta"><i class="fa-solid fa-user"></i> Conta</a>
        <a href="#" class="menu-link" data-section="financeiro"><i class="fa-solid fa-wallet"></i> Financeiro</a>
        <a href="#" class="menu-link" data-section="saude"><i class="fa-solid fa-heart-pulse"></i> Saúde</a>
        <a href="#" class="menu-link" data-section="agenda"><i class="fa-solid fa-calendar-days"></i> Agenda</a>
        <a href="#" class="menu-link" data-section="trabalho"><i class="fa-solid fa-briefcase"></i> Trabalho</a>
        <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sair</a>

        <div class="sidebar-brand">
        LifeTool
        </div>
    </div>

    <div class="content">
        <div id="conta" class="content-section">
            <h2>Informações da Conta</h2>
            <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario_nome); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario_email); ?></p>
        </div>

        <div id="financeiro" class="content-section d-none">
            <h2>Área Financeira</h2>
            <p>Controle de despesas, receitas, orçamentos, etc.</p>
        </div>

        <div id="saude" class="content-section d-none">
            <h2>Área de Saúde</h2>
            <p>Registros médicos, exames, consultas, etc.</p>
        </div>

        <div id="agenda" class="content-section d-none">
            <h2>Agenda</h2>
            <p>Compromissos, calendários e lembretes.</p>
        </div>

        <div id="trabalho" class="content-section d-none">
            <h2>Área de Trabalho</h2>
            <p>Tarefas profissionais, projetos, metas, etc.</p>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        document.querySelectorAll('.menu-link').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelectorAll('.menu-link').forEach(l => l.classList.remove('active-link'));
                this.classList.add('active-link');
                document.querySelectorAll('.content-section').forEach(section => section.classList.add('d-none'));
                const selectedSection = this.getAttribute('data-section');
                document.getElementById(selectedSection).classList.remove('d-none');
            });
        });
    </script>
</body>
</html>
