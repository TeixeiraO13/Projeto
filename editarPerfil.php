<?php
// Simulação de dados do usuário atual
$usuario = [
    'nome' => '$nome',
    'foto' => '$foto'
];

$mensagem = "";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $foto = $_FILES['foto'];

    // Processa o upload da foto (se houver)
    if ($foto['error'] === UPLOAD_ERR_OK) {
        $nomeArquivo = basename($foto['name']);
        $caminhoFoto = 'uploads/' . $nomeArquivo;
        move_uploaded_file($foto['tmp_name'], $caminhoFoto);
        $usuario['foto'] = $caminhoFoto;
    }

    // Simula a atualização (aqui você atualizaria o banco)
    $usuario['nome'] = $nome;

    // Você aplicaria o hash da senha e salvaria também
    // $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $mensagem = "Perfil atualizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="css/editar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Rubik+Bubbles&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Editar Perfil</h1>

        <?php if ($mensagem): ?>
            <p class="mensagem"><?= htmlspecialchars($mensagem) ?></p>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required>

            <label for="senha">Nova Senha:</label>
            <input type="password" id="senha" name="senha">

            <label for="foto">Foto de Perfil:</label>
            <input type="file" id="foto" name="foto">
            <div class="preview">
                <img src="<?= htmlspecialchars($usuario['foto']) ?>" alt="Foto atual" width="120">
            </div>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
