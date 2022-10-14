<?php
ini_set('display_errors', 0);
error_reporting(0);
session_start();

include('../../php/conexao.php');
include('../../php/model.php');

if (!$_SESSION['logado'] && !$_SESSION['artista']) {
    header('Location: ../../index.php');
    exit();
}


$model = new Model;
$model->addEspetaculo();

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Circo</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
    <div class="container">
        <a href="painel.php">
        <img src="../../img/circo.png" width="200px" height="200px" alt="">
        </a>
    </div>
    <h3 style="text-align: center;">Meu Pequeno Circo</h3>
    <a href="../../php/logout.php">Deslogar - <?= $_SESSION['nome'] ?></a>
    <hr>
    <form method="POST">
        <div class="container">
            <div class="field_user">
                <h2 style="margin: 20px;text-align:center;">Adicionar Espetáculo</h2>
                <br>
                <?php if(isset($_SESSION['atualizado'])): ?>
                <label style="color:green;" for="">Usuário atualizado com sucesso!</label><br>
                <br>
                <?php unset($_SESSION['atualizado']);endif; ?>
                <?php if(isset($_SESSION['del_no'])): ?>
                <label style="color:red;" for="">Você não pode se deletar!</label><br>
                <br>
                <?php unset($_SESSION['del_no']);endif; ?>
                <?php if(isset($_SESSION['del'])): ?>
                <label style="color:green;" for="">Deletado com Sucesso!</label><br>
                <br>
                <?php unset($_SESSION['del']);endif; ?>
                <?php if(isset($_SESSION['inserido'])): ?>
                <label style="color:green;" for="">Inserido com Sucesso!</label><br>
                <br>
                <?php unset($_SESSION['inserido']);endif; ?>
                <?php if(isset($_SESSION['n_inserido'])): ?>
                <label style="color:red;" for="">Usuário existente!</label><br>
                <br>
                <?php unset($_SESSION['n_inserido']);endif; ?>
                <label for="">Nome do Espetáculo</label><br>
                <input class="input" type="text" name="titulo" placeholder="Digite o nome do novo espetáculo..."><br>
                <label for="">Capacidade Máxima de Espectadores</label><br>
                <input class="input" type="number" name="capacidade" placeholder="Ex: 1000"><br>
                <label for="">Data de Estreia</label><br>
                <input class="input" type="date" name="data" placeholder="Ex: 1000"><br>
                
                <input type="submit" name="addEspec" style="margin-top: -10px;height:30px;width:91%;" class="input" value="Adicionar"><br>
                <a style="margin:20px;" href="apresentacoes.php">Voltar <</a>


            </div>
        </div>
        </form>
       
    
</body>

</html>