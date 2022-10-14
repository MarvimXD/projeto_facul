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
$model->addArtista();

$id = $_GET['id'];

$sql = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM espetaculos WHERE id = '$id'"));

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
                <h2 style="margin: 20px;text-align:center;">Adicionar Artista ao Espetáculo</h2>
                <br>
                <?php if(isset($_SESSION['del'])): ?>
                <label style="color:green;" for="">Removido com Sucesso!</label><br>
                <br>
                <?php unset($_SESSION['del']);endif; ?>
                <?php if (isset($_SESSION['ja_existe'])) : ?>
                    <label style="color:red;" for="">O Artista já encontra-se neste espetáculo!</label><br>
                    <br>
                <?php unset($_SESSION['ja_existe']);
                endif; ?>
                <?php if(isset($_SESSION['inserido'])): ?>
                <label style="color:green;" for="">Inserido com Sucesso!</label><br>
                <br>
                <?php unset($_SESSION['inserido']);endif; ?>
                <input type="hidden" value="<?= $id ?>" name="espId">
                <h3 style="margin-left: 20px;" for=""><?= ucfirst($sql['titulo']) ?></h3><br>
                <label for="">Capacidade: <?= $sql['capacidade'] ?></label><br>
                <label for="">Data: <?= $sql['data'] ?></label><br>
                <br>
                <label for="">Artista</label><br>
                <select style="height:30px;width:50%;margin-top:0px;" name="artista" class="input" id="">
                    <?php
                    $typ = mysqli_query($conexao, "SELECT * FROM users WHERE type = 2");
                    while ($vt = mysqli_fetch_array($typ)) {
                        echo '<option value="' . $vt['id'] . '">' . $vt['user'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="addArtista" style="margin-top: -10px;height:30px;width:91%;" class="input" value="Adicionar Artista"><br>
                <a style="margin:20px;" href="apresentacoes.php">Voltar <</a>


            </div>
        </div>
    </form>
    <!-- LISTA  -->
    <div class="container">
        <div class="field_user">
            <h2 style="margin: 20px;text-align:center;">Artistas do Espetáculo</h2>
            <br>

            <?php
            $sql = mysqli_query($conexao, "SELECT * FROM artistas_espetaculos WHERE espetaculo = '$id' ORDER BY id DESC");
            while ($v = mysqli_fetch_array($sql)) {

                $idUser = $v['artista'];
                $artista = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM users WHERE id = '$idUser'"));

                echo '<div class="user_list">
                            <div class="user" id="user-nome">
                                <h3>' . $artista['user'] . '</h3>
                            </div>
                            <div class="user" id="user-del">
                                <a style="color:red;" href="../../php/removeArtista.php?id=' . $v['artista'] . '@'.$v['espetaculo'].'">Remover</a>
                            </div>
                        </div>';
            }
            ?>




        </div>


    </div>

</body>

</html>