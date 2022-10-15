<?php
session_start();
include('conexao.php');

$id = $_GET['id'];

if($_SESSION['id'] == $id) {
    $_SESSION['del_no'] = true;
    header('Location: ../pages/artista/painel.php');
    exit();
}
mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS=0");
mysqli_query($conexao, "DELETE FROM users WHERE id = '$id'");
mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS=1");
$_SESSION['del'] = true;
header('Location: ../pages/artista/painel.php');
exit();
