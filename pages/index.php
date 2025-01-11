<?php 
session_start();
require '../includes/connect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body id='meubody'>
    <?php include('../includes/navbar.php'); ?>
    <div class="container mt-4">
        <?php include('../pages/message.php'); ?>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Lista de Usuários
                <a href="create_user.php" class="btn btn-primary float-end">Cadastrar Usuário</a>
              </h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Email</th>
                      <th>Senha</th>
                      <th>Ações</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql =  'SELECT * FROM usuarios';
                    $usuarios = mysqli_query($conexao, $sql);
                    if (mysqli_num_rows($usuarios) > 0) {
                        foreach($usuarios as $usuario){
                    ?>
                    <tr>
                      <td><?=$usuario['id']?></td>
                      <td><?=$usuario['nome']?></td> 
                      <td><?=$usuario['email']?></td>
                      <td>Protegida Por Segurança de Todos!</td>
                      <td>
                        <a href="usuario-view.php?id=<?=$usuario['id']?>" class="btn btn-secondary btn-sm">Visualizar</a>
                        <a href="usuario-edit.php?id=<?=$usuario['id']?>" class="btn btn-success btn-sm">Editar</a>
                        <form action="acoes.php" method="POST" class="d-inline">
                          <button onclick="return confirm('Realmente Deseja Excluir esse Usuário?')" type="submit" name="delete_usuario" value="<?=$usuario['id']?>" class="btn btn-danger btn-sm">
                            Excluir
                          </button>
                        </form>
                      </td>
                    </tr>
                    <?php 
                    }
                  } else {
                    echo '<h5>Nenhum Usuário Encontrado!</h5>';
                  }
                  ?>
                  </tbody>
                </table>
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include('../includes/footer.php'); ?> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
