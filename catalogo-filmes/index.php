<?php
require 'includes/conexao.php';
session_start();

$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE login = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($usuario = $result->fetch_assoc()) {
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            header("Location: dashboard.php");
            exit;
        } else {
            $msg = "Senha incorreta.";
        }
    } else {
        $msg = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
            <label for="login">Login</label>
            <input type="text" name="login" id="login" required>

            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <?php if ($msg): ?>
            <p class="mensagem"><?php echo $msg; ?></p>
        <?php endif; ?>

        <div class="link-cadastro">
            <a href="cadastro.php">Cadastre-se</a>
        </div>
    </div>
</body>
</html>
