<?php
if (isset($_SESSION['mensagem'])):
    $mensagem = $_SESSION['mensagem'];
    $tipo = $_SESSION['tipo'] ?? 'success'; // success, error, warning, info
    unset($_SESSION['mensagem'], $_SESSION['tipo']);
?>
<div id="toast-data" 
     data-message="<?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>" 
     data-type="<?= htmlspecialchars($tipo, ENT_QUOTES, 'UTF-8'); ?>">
</div>
<script src="../assets/js/message.js"></script>
<?php
endif;
?>
