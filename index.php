<?php 

session_start();

include('php/model.php');
$model = (new Model)->userLogin();

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Circo</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <img src="img/circo.png" width="200px" height="200px" alt="">
    </div>
    <h3 style="text-align: center;">Meu Pequeno Circo</h3>
    <hr>
    <form method="post">
        <div class="container">
            <div class="field_user">
                <h2 style="margin: 20px;text-align:center;">Login</h2>
                <br>
                <label for="">Usuário</label><br>
                <input required type="text" class="input" placeholder="Insira seu usuário..." name="user"><br>
                <label for="">Senha</label><br>
                <input required type="password" class="input" placeholder="Insira sua senha..." name="pass"><br>
                <br>
                <input class="input" style="height: 30px;width:91%;" type="submit" name="submit" value="Enviar">
            </div>
        </div>
    </form>
</body>
</html>