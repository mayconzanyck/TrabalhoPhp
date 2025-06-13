<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <link rel="stylesheet" href="css/estilo.css">
    <meta http-equiv="refresh" content="2;url=index.php">
</head>
<body>
    <div class="container">
        <h2>Você saiu com sucesso!</h2>
        <p>Redirecionando para a página de login...</p>
    </div>
</body>
</html>
