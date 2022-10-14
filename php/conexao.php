<?php

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'circo');

$conexao = mysqli_connect(HOST, USER, PASS, DB) or die("Não conectou!");