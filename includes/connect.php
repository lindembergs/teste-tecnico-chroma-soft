<?php
// define('HOST', 'localhost');
define('HOST', 'localhost:3307'); // Se a porta for diferente
define('USUARIO', 'root');
define('SENHA', 'adminadmin');
define('DB', 'users'); 

$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);

if (!$conexao) {
    die("Não conseguiu conectar: " . mysqli_connect_error());
}
?>