<div class="container">
    <div class="starter-template">
            <h1 class="text-center">Banco Home</h1>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <br/><br/><br/><br/><br/><br/>
                    <p>
                        <a href="http://<?php echo APP_HOST; ?>/conta/deposito" class="btn btn-sq-lg btn-primary">                    
                            Depositar
                        </a>
                        <a href="http://<?php echo APP_HOST; ?>/conta/transferencia" class="btn btn-sq-lg btn-success">
                            Transferir
                        </a>
                        <a href="http://<?php echo APP_HOST; ?>/conta/saque" class="btn btn-sq-lg btn-info">
                            Sacar
                        </a>
                        <?php if($Sessao::retornaTipo()=="Conta Poupança"){ ?>
                            <a href="http://<?php echo APP_HOST; ?>/conta/rendimento" class="btn btn-sq-lg btn-warning">
                                Aplicar Rendimento
                            </a>               
                        <?php } ?>
                                              
                    </p>
                    <br/><br/><br/><br/><br/><br/>
                    <h3>Saldo atual R$ <?php echo $Sessao::retornaSaldo();?></h3>
                </div>             
            </div>          
    </div>
</div>
