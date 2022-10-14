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
                <?php if (isset($_SESSION['del'])) : ?>
                    <label style="color:green;" for="">Deletado com Sucesso!</label><br>
                    <br>
                <?php unset($_SESSION['del']);
                endif; ?>
                <h2 style="margin: 20px;text-align:center;">Painel Apresentações</h2>
                <br>
                <label for=""><a href="add_espetaculo.php">> Adicionar Espetáculo</a></label><br>


                <br>
                <a style="margin:20px;" href="painel.php">Voltar <</a>
                <br>


            </div>
        </div>
    </form>
    <!-- PESQUISA 
    <form action="painel_results.php" method="get">
        <div class="container">
            <div class="field_user">
                <h2 style="margin: 20px;text-align:center;">Pesquisar Apresentações</h2>
                <br>

                <input type="text" class="input" name="search" placeholder="Pesquise um artista..."><br>
                <input type="submit" style="margin-top: -10px;height:30px;width:91%;" class="input" value="Pesquisar"><br>
                <br>

            </div>


        </div>
    </form> -->

    <!-- LISTA  -->
    <div class="container">
        <div class="field_user" style="width: 600px;">
            <h2 style="margin: 20px;text-align:center;">Lista de Espetáculos</h2>
            <br>

            <?php
            $sql = mysqli_query($conexao, "SELECT * FROM espetaculos ORDER BY id DESC");
            while ($v = mysqli_fetch_array($sql)) {


                echo '<div class="user_list">
                            <div class="user" id="user-nome">
                                <h3>' . ucfirst($v['titulo']) . '</h3> 
                            </div>
                            <div class="user" id="user-del">
                                <a href="add_artista.php?id=' . $v['id'] . '">+ Artistas |</a>
                                <a style="color:red;" href="../../php/deleteEsp.php?id=' . $v['id'] . '"> | Deletar</a>
                            </div>
                        </div>';
            }
            ?>




        </div>


    </div>

</body>

</html>