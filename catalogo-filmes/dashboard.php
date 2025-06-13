<?php
require 'includes/conexao.php';
require 'includes/funcoes.php';
verificaLogin();

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM itens WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🎬 Bem-vindo à sua Lista de Filmes</h2>
        <div>
            <a href="novo_item.php" class="btn btn-success me-2">+ Novo Filme</a>
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </div>

    <hr class="border-light">

    <h4>Seus Filmes:</h4>

    <?php if ($result->num_rows > 0): ?>
        <div class="list-group">
            <?php while ($item = $result->fetch_assoc()): ?>
                <div class="list-group-item list-group-item-action bg-secondary text-white mb-3 rounded">
                    <h5><?php echo htmlspecialchars($item['titulo']); ?></h5>
                    <p><?php echo nl2br(htmlspecialchars($item['descricao'])); ?></p>
                    <small class="text-light">Cadastrado em: <?php echo date('d/m/Y H:i', strtotime($item['data_criacao'])); ?></small><br>
                    <a href="editar_item.php?id=<?php echo $item['id']; ?>" class="btn btn-warning btn-sm mt-2">Editar</a>
                    <a href="excluir_item.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm mt-2" onclick="return confirm('Tem certeza que deseja excluir este filme?');">Excluir</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>Você ainda não cadastrou nenhum filme.</p>
    <?php endif; ?>

</div>
</body>
</html>
