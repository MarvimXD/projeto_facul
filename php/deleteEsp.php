<?php
session_start();
include('conexao.php');

$id = $_GET['id'];

mysqli_query($conexao, "DELETE FROM espetaculos WHERE id = '$id'");
$_SESSION['del'] = true;
header('Location: ../pages/artista/apresentacoes.php');
exit();
