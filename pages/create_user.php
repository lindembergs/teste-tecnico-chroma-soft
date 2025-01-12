<?php
session_start();
require '../includes/connect.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Usuário - Sistema</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="bg-light">
    <?php include('../includes/navbar.php'); ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card form-card">
                    <div class="card-header">
                        <div class="form-header">
                            <div>
                                <h4 class="form-title">Cadastro de Usuário</h4>
                                <p class="form-subtitle">Preencha os dados para criar um novo usuário</p>
                            </div>
                            <a href="index.php" class="btn btn-back">
                                <i class="fas fa-arrow-left"></i>
                                Voltar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="../actions/actions.php" method="POST" id="createUserForm" novalidate>
                            <div class="form-group">
                                <label class="form-label" for="nome">Nome</label>
                                <input type="text" 
                                       name="nome" 
                                       id="nome" 
                                       class="form-control" 
                                       required
                                       minlength="3"
                                       placeholder="Digite o nome completo">
                                <div class="invalid-feedback">
                                    O nome deve ter pelo menos 3 caracteres
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       class="form-control" 
                                       required
                                       placeholder="exemplo@email.com">
                                <div class="invalid-feedback">
                                    Por favor, insira um email válido
                                </div>
                                <div class="form-help">
                                    Este email será usado para login no sistema
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="senha">Senha</label>
                                <div class="password-wrapper">
                                    <input type="password" 
                                           name="senha" 
                                           id="senha" 
                                           class="form-control" 
                                           required
                                           minlength="6"
                                           placeholder="Digite sua senha">
                                    <button type="button" 
                                            class="password-toggle" 
                                            onclick="togglePassword()">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">
                                    A senha deve ter pelo menos 6 caracteres
                                </div>
                                <div class="form-help">
                                    Use pelo menos 6 caracteres
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="d-grid">
                                <button type="submit" 
                                        name="create_user" 
                                        class="btn btn-submit" 
                                        id="submitBtn">
                                    <i class="fas fa-user-plus me-2"></i>
                                    Criar Usuário
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
   

    const form = document.getElementById('createUserForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            submitBtn.classList.add('btn-loading');
        }
        form.classList.add('was-validated');
    });


    function togglePassword() {
        const passwordInput = document.getElementById('senha');
        const icon = document.querySelector('.password-toggle i');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', function() {
        if (emailInput.validity.valid) {
            emailInput.classList.remove('is-invalid');
            emailInput.classList.add('is-valid');
        } else {
            emailInput.classList.remove('is-valid');
            emailInput.classList.add('is-invalid');
        }
    });
    </script>
</body>
</html>