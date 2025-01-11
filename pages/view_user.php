<?php 
require '../includes/connect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Usuário</title>
    <link 
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
      crossorigin="anonymous"
    >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
      body {
        background-color: #f8f9fa; /* Fundo claro */
      }
      .card {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
      }
      .card-header {
        background-color: #343a40;
        color: #fff;
        border-radius: 10px 10px 0 0;
      }
      .card-body {
        padding: 30px;
      }
      .form-control {
        border: none;
        background-color: #f8f9fa;
        font-weight: bold;
      }
      .btn-warning {
        background-color: #ffc107;
        border: none;
        transition: all 0.3s ease;
      }
      .btn-warning:hover {
        background-color: #e0a800;
      }
    </style>
  </head>
  <body>
  
    <?php include('../includes/navbar.php'); ?>
   
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h4 class="mb-0">Visualizar Usuário</h4>
              <a href="index.php" class="btn btn-back">
                                <i class="fas fa-arrow-left"></i>
                                Voltar
                            </a>
            </div>
            <div class="card-body">
              <?php
                if (isset($_GET['id'])){
                    $usuario_id = mysqli_real_escape_string($conexao, $_GET['id']);
                    $sql = "SELECT * FROM usuarios WHERE id='$usuario_id'";
                    $query = mysqli_query($conexao, $sql);

                    if(mysqli_num_rows($query) > 0){
                        $usuario = mysqli_fetch_array($query);
              ?>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Nome:</label>
                <div class="col-sm-8">
                  <p class="form-control"><?=$usuario['nome'];?></p>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Email:</label>
                <div class="col-sm-8">
                  <p class="form-control"><?=$usuario['email'];?></p>
                </div>
              </div>
              <div class="row mb-3">
                <label class="col-sm-4 col-form-label">Senha:</label>
                <div class="col-sm-8">
                  <p class="form-control">Protegida Por Segurança de Todos!</p>
                </div>
              </div>
              <?php
                } else {
                    echo "<h5 class='text-center'>Usuário Não Encontrado!</h5>";
                }
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
      crossorigin="anonymous"
    ></script>
  </body>
</html>
