<?php
require 'includes/conexao.php';
require 'includes/funcoes.php';
verificaLogin();

$usuario_id = $_SESSION['usuario_id'];

$sql = "SELECT * FROM itens WHERE usuario_id = ? ORDER BY data_criacao DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meus Filmes</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h2>Meus Filmes</h2>
            <div class="header-buttons">
                <a href="dashboard.php" class="btn">Voltar</a>
                <a href="novo_item.php" class="btn btn-primary">+ Novo Filme</a>
                <a href="logout.php" class="btn btn-danger">Sair</a>
            </div>
        </header>
        <hr>

        <?php if ($result->num_rows > 0): ?>
            <div class="item-list">
                <?php while ($item = $result->fetch_assoc()): ?>
                    <div class="item-card">
                        <h3><?php echo htmlspecialchars($item['titulo']); ?></h3>
                        <p><?php echo nl2br(htmlspecialchars($item['descricao'])); ?></p>
                        <small>Cadastrado em: <?php echo date('d/m/Y H:i', strtotime($item['data_criacao'])); ?></small><br>
                        <a href="editar_item.php?id=<?php echo $item['id']; ?>" class="btn btn-warning">Editar</a>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>Você ainda não cadastrou nenhum filme.</p>
        <?php endif; ?>
    </div>
</body>
</html>
