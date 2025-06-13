<?php
$servidor = "localhost";
$porta = 3307;
$usuario = "root";
$senha = "minhasenha123";
$banco = "catalogo_filmes";

$conn = new mysqli($servidor, $usuario, $senha, $banco, $porta);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>