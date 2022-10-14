<?php
session_start();
include('conexao.php');

$id = $_GET['id'];

if($_SESSION['id'] == $id) {
    $_SESSION['del_no'] = true;
    header('Location: ../pages/artista/painel.php');
    exit();
}

mysqli_query($conexao, "DELETE FROM users WHERE id = '$id'");
$_SESSION['del'] = true;
header('Location: ../pages/artista/painel.php');
exit();
