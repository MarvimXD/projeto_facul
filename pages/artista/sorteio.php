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
$model->sorteio();

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

                <h2 style="margin: 20px;text-align:center;">Sorteio</h2>
                <br>
                <?php if (isset($_SESSION['inserido'])) : ?>
                    <h3 style="color:green;margin-left:20px;" for="">Vencedor(a): <?= $_SESSION['inserido'] ?></h3><br>
                    <br>
                <?php unset($_SESSION['inserido']);
                endif; ?>

                <input type="submit" name="sortear" style="width: 92%;height:30px;" value="Sortear Espectador" class="input">


                <br>
                <a style="margin:20px;" href="painel.php">Voltar <</a>
                <br>


            </div>
        </div>
    </form>
    <!-- LISTA  -->
    <div class="container">
        <div class="field_user">
            <h2 style="margin: 20px;text-align:center;">Últimos Sorteios</h2>
            <br>

            <?php
            $sql = mysqli_query($conexao, "SELECT * FROM sorteios ORDER BY data_sistema DESC");
            while ($v = mysqli_fetch_array($sql)) {

                $idUser = $v['espectador'];
                $user = mysqli_fetch_array(mysqli_query($conexao, "SELECT * FROM users WHERE id = '$idUser'"));

                echo '<div class="user_list">
                            <div class="user" id="user-nome">
                                <h3>' . $user['user'] . ' </h3>
                            </div>
                            <div class="user" id="user-del">
                                <p> Em: ' . $v['data'] . '</p>
                            </div>
                        </div>';
            }
            ?>




        </div>


    </div>


</body>

</html>