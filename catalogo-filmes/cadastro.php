<?php
require 'includes/conexao.php';

$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $email = $_POST['email'];

    if (empty($login) || empty($senha) || empty($email)) {
        $msg = "Preencha todos os campos.";
    } else {
        // Verifica se o login já existe
        $sql = "SELECT id FROM usuarios WHERE login = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $msg = "Este login já está em uso. Escolha outro.";
        } else {
            // Se não existe, insere o novo usuário
            $sql = "INSERT INTO usuarios (login, senha, email) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $login, $senha, $email);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit;
            } else {
                $msg = "Erro ao cadastrar. Tente novamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Cadastro</h2>
        <form method="POST" class="form">
            <label>Login:</label>
            <input type="text" name="login" required>

            <label>Senha:</label>
            <input type="password" name="senha" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <button type="submit">Cadastrar</button>
        </form>

        <p class="mensagem"><?php echo $msg; ?></p>
        <a href="index.php">Voltar ao login</a>
    </div>
</body>
</html>
