<?php

// define('HOST', 'localhost');
// define('USER', 'id19712670_root');
// define('PASS', '9%*rVFjsk=2-J1G6');
// define('DB', 'id19712670_circo');

define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB', 'circo');


$conexao = mysqli_connect(HOST, USER, PASS, DB) or die("Não conectou!");