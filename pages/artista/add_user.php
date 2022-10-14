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
$model->addUser();

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
        <a href="#">
        <img src="../../img/circo.png" width="200px" height="200px" alt="">
        </a>
    </div>
    <h3 style="text-align: center;">Meu Pequeno Circo</h3>
    <a href="../../php/logout.php">Deslogar - <?= $_SESSION['nome'] ?></a>
    <hr>
    <form method="POST">
        <div class="container">
            <div class="field_user">
                <h2 style="margin: 20px;text-align:center;">Adicionar Usuário</h2>
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
                <label for="">Usuário</label><br>
                <input class="input" type="text" name="user" placeholder="Digite o novo usuário..."><br>
                <label for="">Senha</label><br>
                <input class="input" type="password" name="pass" placeholder="Digite a senha..."><br>
                <label for="">Tipo</label><br>
                <select style="height:30px;width:50%;" name="type" class="input" id="">
                    <?php
                    $typ = mysqli_query($conexao, "SELECT * FROM users_type");
                    while($vt = mysqli_fetch_array($typ)) {
                        echo '<option value="'.$vt['id'].'">'.ucfirst($vt['type']).'</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="novoUser" style="margin-top: -10px;height:30px;width:91%;" class="input" value="Adicionar"><br>
                <a style="margin:20px;" href="painel.php">Voltar <</a>


            </div>
        </div>
        </form>
       
    
</body>

</html>