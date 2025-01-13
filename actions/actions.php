<?php
// Mostrar erros apenas no ambiente de desenvolvimento
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../includes/connect.php';


function definirMensagem($mensagem, $tipo = 'success', $local = '../pages/index.php') {
    $_SESSION['mensagem'] = $mensagem;
    $_SESSION['tipo'] = $tipo;
    header("Location: $local");
    exit;
}

function validarCampo($campo) {
    return isset($campo) && trim($campo) !== '';
}

// Criação de usuário
if (isset($_POST['create_user'])) {
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome'] ?? ''));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email'] ?? ''));
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, trim($_POST['senha'])) : null;
    if (!validarCampo($nome) || !validarCampo($email) || !validarCampo($senha)) {
        definirMensagem('Preencha todos os campos obrigatórios!', 'error');
    }
    if (strlen($senha) < 6) {
        definirMensagem('A senha deve ter pelo menos 6 caracteres!', 'error');
    }
    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexao, $sql_check_email);

    if (mysqli_num_rows($result) > 0) {
        definirMensagem('O e-mail já está cadastrado!', 'error');
    }
    $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_cripto')";

    if (mysqli_query($conexao, $sql) && mysqli_affected_rows($conexao) > 0) {
        definirMensagem('Usuário Criado com Êxito!');
    } else {
        definirMensagem('Erro ao Criar Usuário!', 'error');
    }
}

// Edição de usuário
if (isset($_POST['edit_user'])) {
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome'] ?? ''));
    $email = mysqli_real_escape_string($conexao, trim($_POST['email'] ?? ''));
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, trim($_POST['senha'])) : null;

    if (!validarCampo($nome) || !validarCampo($email)) {
        definirMensagem('Preencha todos os campos obrigatórios!', 'error');
    }

    if ($senha && strlen($senha) < 6) {
        definirMensagem('A senha deve ter pelo menos 6 caracteres!', 'error');
    }
    if ($senha) {
        $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha_cripto' WHERE id = '$usuario_id'";
    } else {
        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = '$usuario_id'";
    }

    if (mysqli_query($conexao, $sql) && mysqli_affected_rows($conexao) > 0) {
        definirMensagem('Usuário Atualizado com Êxito!');
    } else {
        definirMensagem('Erro ao Atualizar Usuário!', 'error');
    }
}

// Exclusão de usuário
if (isset($_POST['delete_user'])) {
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_user']);

    $sql = "DELETE FROM usuarios WHERE id = '$usuario_id'";

    if (mysqli_query($conexao, $sql) && mysqli_affected_rows($conexao) > 0) {
        definirMensagem('Usuário Deletado com Sucesso!');
    } else {
        definirMensagem('Erro ao Deletar Usuário!', 'error');
    }
}
?>
