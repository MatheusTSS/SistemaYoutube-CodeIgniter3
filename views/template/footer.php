<footer class="main-footer">
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="dashboard">Sistema YouTube</a>.</strong>
    Todos os direitos são reservados.
    <div class="float-right d-none d-sm-inline-block">
        <b>Ultimo Acesso: </b> 
        <?php
        date_default_timezone_set('America/Sao_Paulo');
        echo date('d/m/Y H:i:s')
        ?>
    </div>
</footer>