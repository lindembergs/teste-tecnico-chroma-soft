<?php 
session_start();
require '../includes/connect.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuário - Editar</title>
    <link 
    
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/navbar.php'); ?>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Editar Usuário</h4>
                        <a href="index.php" class="btn btn-back">
                                <i class="fas fa-arrow-left"></i>
                                Voltar
                            </a>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']);
                            $sql = "SELECT * FROM usuarios WHERE id=$usuario_id";
                            $query = mysqli_query($conexao, $sql);

                            if (mysqli_num_rows($query) > 0) {
                                $usuario = mysqli_fetch_array($query);
                        ?>
                        <form action="../actions/actions.php" method="POST">
                            <input type="hidden" name="usuario_id" value="<?= htmlspecialchars($usuario['id']) ?>">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input 
                                    type="text" 
                                    id="nome" 
                                    name="nome" 
                                    value="<?= htmlspecialchars($usuario['nome']) ?>" 
                                    class="form-control" 
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="<?= htmlspecialchars($usuario['email']) ?>" 
                                    class="form-control" 
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input 
                                    type="password" 
                                    id="senha" 
                                    name="senha" 
                                    class="form-control" 
                                    required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="edit_user" class="btn btn-primary">Salvar</button>
                            </div>
                        </form>
                        <?php
                            } else {
                                echo "<div class='alert alert-danger'>Usuário não encontrado!</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>ID do usuário não informado!</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../includes/footer.php'); ?>

    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous">
    </script>
</body>
</html>
