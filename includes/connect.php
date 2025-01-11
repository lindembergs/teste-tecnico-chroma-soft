<?php
// define('HOST', 'localhost');
define('HOST', 'localhost:3307'); // Se a porta for diferente
define('USUARIO', 'root');
define('SENHA', 'adminadmin');
define('DB', 'users'); 

// Conexão com o banco de dados
$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB);

// Verificar se a conexão foi bem-sucedida
if (!$conexao) {
    die("Não conseguiu conectar: " . mysqli_connect_error());
}
?>