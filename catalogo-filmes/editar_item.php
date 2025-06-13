<?php
require 'includes/conexao.php';
require 'includes/funcoes.php';
verificaLogin();

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];
$msg = '';

$sql = "SELECT * FROM itens WHERE id = ? AND usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $usuario_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$item = $result->fetch_assoc()) {
    die("Item não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];

    if (empty($titulo) || empty($descricao)) {
        $msg = "Preencha todos os campos.";
    } else {
        $sql = "UPDATE itens SET titulo = ?, descricao = ? WHERE id = ? AND usuario_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $titulo, $descricao, $id, $usuario_id);
        $stmt->execute();
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Filme</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Editar Filme</h2>
        <form method="POST">
            <input type="text" name="titulo" placeholder="Título" value="<?php echo htmlspecialchars($item['titulo']); ?>">
            <textarea name="descricao" rows="4" placeholder="Descrição"><?php echo htmlspecialchars($item['descricao']); ?></textarea>
            <button type="submit">Salvar Alterações</button>
        </form>
        <p><?php echo $msg; ?></p>
        <a href="dashboard.php">Voltar</a>
    </div>
</body>
</html>
