<?php
session_start();

function verificaLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: index.php');
        exit;
    }
}
?>
