<?php
session_start();
include('conexao.php');

$id = $_GET['id'];

$partes = explode('@', $id);
$artista = $partes['0'];
$espetaculo = $partes[1];

mysqli_query($conexao, "DELETE FROM artistas_espetaculos WHERE artista = '$artista' AND espetaculo = '$espetaculo'");
$_SESSION['del'] = true;
header('Location: ../pages/artista/add_artista.php?id='.$espetaculo);
exit();
