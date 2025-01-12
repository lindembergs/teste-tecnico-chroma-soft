<?php 
session_start();
require '../includes/connect.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/global.css">
  </head>
  <body>
    <?php include('../includes/navbar.php'); ?>
    
    <div class="container mt-4">
        <?php include('../pages/message.php'); ?>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <div>
                                Lista de Usuários
                                <small class="text-muted d-block fs-6">Gerencie os usuários do sistema</small>
                            </div>
                            <a href="create_user.php" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Cadastrar Usuário
                            </a>
                        </h4>
                    </div>
                    
                    <div class="card-body">
            
                        <div class="search-wrapper mb-4">
                            <i class="fas fa-search"></i>
                            <input type="text" 
                                   id="searchInput" 
                                   class="form-control search-input ps-10" 
                                   placeholder="Buscar usuários..."
                                   onkeyup="filterTable()">
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-custom" id="usersTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th class="text-end">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT * FROM usuarios ORDER BY id DESC";
                                    $stmt = mysqli_prepare($conexao, $query);
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);

                                    if (mysqli_num_rows($result) > 0) {
                                        while($usuario = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($usuario['id']) ?></td>
                                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                                        <td>
                                            <span class="badge badge-status badge-active">Ativo</span>
                                        </td>
                                        <td>
                                            <div class="actions-group justify-content-end">
                                                <a href="view_user.php?id=<?= $usuario['id'] ?>" 
                                                   class="btn btn-outline-secondary btn-action" 
                                                   title="Visualizar">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="edit_user.php?id=<?= $usuario['id'] ?>" 
                                                   class="btn btn-outline-success btn-action" 
                                                   title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="../actions/actions.php" method="POST" class="d-inline">
                                                    <button type="submit" 
                                                            name="delete_user" 
                                                            value="<?= $usuario['id'] ?>" 
                                                            class="btn btn-outline-danger btn-action"
                                                            onclick="return confirmDelete()"
                                                            title="Excluir">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    } else {
                                        echo '<tr><td colspan="5" class="text-center">Nenhum usuário encontrado</td></tr>';
                                    }
                                    mysqli_stmt_close($stmt);
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmDelete() {
        return confirm('Tem certeza que deseja excluir este usuário?');
    }

    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('usersTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            
            for (let j = 0; j < cells.length; j++) {
                const cell = cells[j];
                if (cell) {
                    const text = cell.textContent || cell.innerText;
                    if (text.toLowerCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            
            rows[i].style.display = found ? '' : 'none';
        }
    }
    </script>
  </body>
</html>