<?php
session_start();
include('conexao.php');

$id = $_GET['id'];

mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS=0");
mysqli_query($conexao, "DELETE FROM espetaculos WHERE id = '$id'");
mysqli_query($conexao, "SET FOREIGN_KEY_CHECKS=1");
$_SESSION['del'] = true;
header('Location: ../pages/artista/apresentacoes.php');
exit();
