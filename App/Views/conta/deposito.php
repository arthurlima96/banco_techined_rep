<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Deposito</h3>

            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/conta/depositar" method="post" id="form_deposito">
                <div class="form-group">
                    <label for="nome">Valor</label>
                    <input type="number" class="form-control" name="valor" value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>" min="1" step="0.01" required>                    
                </div>
                
                <button type="submit" class="btn btn-success btn-sm">Depositar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>