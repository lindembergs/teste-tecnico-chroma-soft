<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../includes/connect.php';

// Criar usuário
if (isset($_POST['create_user'])) {
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome'])); 
    $email = mysqli_real_escape_string($conexao, trim($_POST['email'])); 
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, trim($_POST['senha'])) : null;

    // Validar senha (mínimo 6 caracteres)
    if (strlen($senha) < 6) {
        $_SESSION['mensagem'] = 'A senha deve ter pelo menos 6 caracteres!';
        header('Location: ../pages/index.php');
        exit;
    }

    // Verificar se o e-mail já está cadastrado
    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexao, $sql_check_email);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['mensagem'] = 'O e-mail já está cadastrado!';
        header('Location: ../pages/index.php');
        exit;
    }

    // Criptografar a senha
    $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

    // Inserir usuário
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha_cripto')";

    mysqli_query($conexao, $sql); 
    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Usuário Criado com Êxito!'; 
        header('Location: ../pages/index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao Criar Usuário!'; 
        header('Location: ..pages/index.php');
        exit;
    }
}

// Atualizar ele
if (isset($_POST['edit_user'])) {
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['usuario_id']);
    $nome = mysqli_real_escape_string($conexao, trim($_POST['nome'])); 
    $email = mysqli_real_escape_string($conexao, trim($_POST['email'])); 
    $senha = isset($_POST['senha']) ? mysqli_real_escape_string($conexao, trim($_POST['senha'])) : null;

    //menos de 6 caracteres
    if ($senha && strlen($senha) < 6) {
        $_SESSION['mensagem'] = 'A senha deve ter pelo menos 6 caracteres!';
        header('Location: ../pages/index.php');
        exit;
    }

    if ($senha) {
        $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', senha = '$senha_cripto' WHERE id = '$usuario_id'";
    } else {
        $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = '$usuario_id'";
    }

    mysqli_query($conexao, $sql); 
    if (mysqli_affected_rows($conexao) > 0) {
        $_SESSION['mensagem'] = 'Usuário Atualizado com Êxito!'; 
        header('Location: ../pages/index.php');
        exit;
    } else {
        $_SESSION['mensagem'] = 'Erro ao Atualizar Usuário!'; 
        header('Location: ../pages/index.php');
        exit;
    }
}

// Excluir usuário
if (isset($_POST['delete_user'])){
    $usuario_id = mysqli_real_escape_string($conexao, $_POST['delete_user']);
    
    $sql = "DELETE FROM usuarios WHERE id = '$usuario_id'";
    
    mysqli_query($conexao, $sql);

    if (mysqli_affected_rows($conexao) > 0 ){
        $_SESSION['message'] = 'Usuário Deletado com Sucesso!';
        header('Location: ../pages/index.php');
        exit;
    } else {
        $_SESSION['message'] = 'Usuário Não foi Deletado!';
        header('Location: ../pages/index.php');
        exit;
    }
}

?>
