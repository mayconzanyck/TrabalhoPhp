<?php
require 'includes/conexao.php';
require 'includes/funcoes.php';
verificaLogin();

if (!isset($_GET['id'])) {
    die("ID inválido.");
}

$id = $_GET['id'];
$usuario_id = $_SESSION['usuario_id'];

$sql = "DELETE FROM itens WHERE id = ? AND usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id, $usuario_id);

if ($stmt->execute()) {
    header("Location: dashboard.php");
    exit;
} else {
    echo "Erro ao excluir item.";
}
?>
