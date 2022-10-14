<?php

include('conexao.php');

class Model
{

    private $host = HOST;
    private $user = USER;
    private $pass = PASS;
    private $db = DB;
    private $conexao;

    public function __construct()
    {

        try {
            $this->conexao = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        } catch (Exception $e) {
            die("Não foi possível conectar ao banco de dados!");
        }
    }

    public function userLogin()
    {

        if (isset($_POST['submit'])) {
            $user = mysqli_real_escape_string($this->conexao, trim($_POST['user']));
            $pass = mysqli_real_escape_string($this->conexao, trim(md5($_POST['pass'])));

            $sql = mysqli_query($this->conexao, "SELECT * FROM users WHERE user = '$user' AND password = '$pass'");
            $count = mysqli_num_rows($sql);

            if ($count != 0) {

                $v = mysqli_fetch_array($sql);

                if ($v['type'] == 2) { // ARTISTA
                    $_SESSION['id'] = $v['id'];
                    $_SESSION['nome'] = $v['user'];
                    $_SESSION['logado'] = true;
                    $_SESSION['artista'] = true;
                    header('Location: pages/artista/painel.php');
                    exit();
                } else if ($v['type'] == 1) { // CLIENTE
                    $_SESSION['id'] = $v['id'];
                    $_SESSION['nome'] = $v['user'];
                    $_SESSION['logado'] = true;
                    $_SESSION['cliente'] = true;
                    header('Location: pages/artista/cliente.php');
                    exit();
                }
            }
        }
    }

    public function addUser()
    {

        if (isset($_POST['novoUser'])) {
            if (!empty($_POST['user']) && !empty($_POST['pass'])) {
                $user = mysqli_real_escape_string($this->conexao, trim($_POST['user']));
                $pass = mysqli_real_escape_string($this->conexao, trim(md5($_POST['pass'])));
                $type = mysqli_real_escape_string($this->conexao, $_POST['type']);

                $test = mysqli_num_rows(mysqli_query($this->conexao, "SELECT * FROM users WHERE user = '$user'"));

                if ($test != 0) {
                    $_SESSION['n_inserido'] = true;
                    header('Location: ../../pages/artista/add_user.php');
                    exit();
                }

                $sql = mysqli_query($this->conexao, "INSERT INTO users (user, password, type) VALUES ('$user', '$pass', '$type')");

                $_SESSION['inserido'] = true;
                header('Location: ../../pages/artista/add_user.php');
                exit();
            }
        }
    }


    public function editUser()
    {
        if (isset($_POST['editUser'])) {

            $uid = mysqli_real_escape_string($this->conexao, trim($_POST['uid']));
            $user = mysqli_real_escape_string($this->conexao, trim($_POST['user']));
            $pass = mysqli_real_escape_string($this->conexao, trim(md5($_POST['pass'])));
            $type = mysqli_real_escape_string($this->conexao, trim($_POST['type']));

            $sql = mysqli_query($this->conexao, "UPDATE users SET user = '$user', password = '$pass', type = '$type' WHERE id = '$uid'");
            $_SESSION['atualizado'] = true;
            header('Location: ../../pages/artista/painel.php');
            exit();
        }
    }


    public function addEspetaculo()
    {

        if (isset($_POST['addEspec'])) {

            $titulo = mysqli_real_escape_string($this->conexao, trim($_POST['titulo']));
            $capacidade = mysqli_real_escape_string($this->conexao, trim($_POST['capacidade']));
            $data = mysqli_real_escape_string($this->conexao, trim($_POST['data']));

            $sql = mysqli_query($this->conexao, "INSERT INTO espetaculos (titulo, capacidade, data) VALUES ('$titulo', '$capacidade', '$data')");
            $_SESSION['inserido'] = true;
            header('Location: ../../pages/artista/add_espetaculo.php');
            exit();
        }
    }



    public function addArtista()
    {
        if (isset($_POST['addArtista'])) {
            $espId = mysqli_real_escape_string($this->conexao, trim($_POST['espId']));
            $artista = mysqli_real_escape_string($this->conexao, trim($_POST['artista']));

            $test = mysqli_num_rows(mysqli_query($this->conexao, "SELECT * FROM artistas_espetaculos WHERE artista = '$artista' AND espetaculo = '$espId'"));
            if ($test != 0) {
                $_SESSION['ja_existe'] = true;
                header('Location: ../../pages/artista/add_artista.php?id='.$espId);
                exit();
            }

            $sql = mysqli_query($this->conexao, "INSERT INTO artistas_espetaculos (artista, espetaculo) VALUES ('$artista', '$espId')");
            $_SESSION['inserido'] = true;
            header('Location: ../../pages/artista/add_artista.php?id='.$espId);
            exit();

        }
    }
}
