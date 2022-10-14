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
$model->editUser();

$id = $_GET['id'];

$sql = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM users WHERE id = '$id'"));
$idType = $sql['type'];
$sqlType = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM users_type WHERE id = '$idType'"))

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
                <h2 style="margin: 20px;text-align:center;">Painel - Editar Usuário</h2>
                <br>
                <input type="hidden" value="<?= $id ?>" name="uid">
                <label for="">Usuário</label><br>
                <input class="input" required type="text" name="user" value="<?= $sql['user'] ?>"><br>
                <label for="">Nova Senha</label><br>
                <input class="input" required type="password" name="pass" placeholder="Digite a nova senha..."><br>
                <label for="">Tipo</label><br>
                <p style="margin-left: 20px;margin-top:5px;">Atual: <?= $sqlType['type'] ?></p>
                <select style="height:30px;width:50%;margin-top:0px;" name="type" class="input" id="">
                    <!-- <option value="<?= $sql['type'] ?>">Atual: <?= $sqlType['type'] ?></option> -->
                    <?php
                    $typ = mysqli_query($conexao, "SELECT * FROM users_type");
                    while ($vt = mysqli_fetch_array($typ)) {
                        echo '<option value="' . $vt['id'] . '">' . ucfirst($vt['type']) . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="editUser" style="margin-top: -10px;height:30px;width:91%;" class="input" value="Atualizar"><br>
                <a style="margin:20px;" href="painel.php">Voltar <</a>


            </div>
        </div>
    </form>

</body>

</html>