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

$pesquisa = $_GET['search'];

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
        <img src="../../img/circo.png" width="200px" height="200px" alt="">
    </div>
    <h3 style="text-align: center;">Meu Pequeno Circo</h3>
    <a href="../../php/logout.php">Deslogar - <?= $_SESSION['nome'] ?></a>
    <hr>
    <form method="POST">
        <div class="container">
            <div class="field_user">
                <h2 style="margin: 20px;text-align:center;">Painel</h2>
                <br>
                <?php if(isset($_SESSION['inserido'])): ?>
                <label style="color:green;" for="">Inserido com Sucesso!</label><br>
                <br>
                <?php unset($_SESSION['inserido']);endif; ?>
                <?php if(isset($_SESSION['n_inserido'])): ?>
                <label style="color:red;" for="">Usuário existente!</label><br>
                <br>
                <?php unset($_SESSION['n_inserido']);endif; ?>
                <label for="">Adicionar Usuário</label><br>
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


            </div>
        </div>
        </form>
        <!-- PESQUISA  -->
        <form action="painel_results.php" method="get">
        <div class="container">
            <div class="field_user">
                <h2 style="margin: 20px;text-align:center;">Pesquisar Usuário</h2>
                <br>

                <input type="text" class="input" name="search" placeholder="Pesquise um artista..."><br>
                <input type="submit" style="margin-top: -10px;height:30px;width:91%;" class="input" value="Pesquisar"><br>
                <br>

            </div>


        </div>
        </form>
        <!-- LISTA  -->
        <div class="container">
            <div class="field_user">
                <h2 style="margin: 20px;text-align:center;">Lista de Usuários</h2>
                <br>

                <?php
                $sql = mysqli_query($conexao, "SELECT * FROM users WHERE user LIKE '%$pesquisa%' ORDER BY id DESC");
                while ($v = mysqli_fetch_array($sql)) {

                    $idType = $v['type'];
                    $type = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM users_type WHERE id = '$idType'"));

                    echo '<div class="user_list">
                            <div class="user" id="user-nome">
                                <h3>'.$v['user'].' - </h3> <p> '.$type['type'].'</p>
                            </div>
                            <div class="user" id="user-del">
                                <a href="../../php/deleteUser.php?id='.$v['id'].'">Deletar</a>
                            </div>
                        </div>';
                }
                ?>




            </div>


        </div>
    
</body>

</html>