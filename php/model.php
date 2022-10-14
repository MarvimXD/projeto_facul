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
                    header('Location: ../../pages/artista/painel.php');
                    exit();
                }

                $sql = mysqli_query($this->conexao, "INSERT INTO users (user, password, type) VALUES ('$user', '$pass', '$type')");

                $_SESSION['inserido'] = true;
                header('Location: ../../pages/artista/painel.php');
                exit();
            }
        }
    }

    

}
