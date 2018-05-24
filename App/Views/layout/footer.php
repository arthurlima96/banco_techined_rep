    <footer class="footer">
        <div class="container">
            <p class="text-muted">

            <?php if($Sessao::retornaUsuario()){ ?>
                <span class="label label-default">Emaill</span>
                <span class="label label-primary"><?= $Sessao::retornaUsuario() ?></span>

                <span class="label label-default">Agencia</span>
                <span class="label label-primary"><?= $Sessao::retornaAgencia() ?></span>

                <span class="label label-default">Numero</span>
                <span class="label label-primary"><?= $Sessao::retornaNumero() ?></span>  

                <span class="label label-default">Tipo Conta</span>
                <span class="label label-primary"><?= $Sessao::retornaTipo() ?></span>     
            <?php } ?>
                
            </p>
        </div>
    </footer>

    <script src="http://<?php echo APP_HOST; ?>/public/js/jquery-3.2.1.min.js"></script>
    <script src="http://<?php echo APP_HOST; ?>/public/js/jquery.validate.min.js"type="text/javascript"></script>
    <script src="http://<?php echo APP_HOST; ?>/public/js/validacao.js"type="text/javascript"></script>
    <script src="http://<?php echo APP_HOST; ?>/public/js/bootstrap.min.js"></script>
</body>
</html>