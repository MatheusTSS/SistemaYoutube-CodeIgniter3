<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alteração das Informações do Produto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Produtos</li>
                        <li class="breadcrumb-item active">Alteração das Informações do Produto</li>
                    </ol>
                </div>        
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-warning">

                        <?php
                        if (isset($msg)) {
                            echo '<div class="box-header with-border">' . $msg . '</div>';
                        }
                        if ((isset($resultadoProduto)) && (!empty($resultadoProduto))) {
                            foreach ($resultadoProduto as $prod) {
                                ?>
                                <div class="card-body">
                                    <form role="form" action="alteraproduto" method="post"
                                          class="form-horizontal">
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label for="descricaoproduto" class="col-sm-2 control-label">ID do Produto</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="produtoid" name="produtoid" value="<?php echo $prod->id; ?>" readonly="readonly">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="descricaoproduto" class="col-sm-2 control-label">Descrição do Produto</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="descricaoproduto" name="descricaoproduto"
                                                           placeholder="Informe a descrição do produto" value="<?php echo $prod->descricaoproduto; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="unidade" class="col-sm-2 control-label">Unidade de Venda</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="unidade" name="unidade">
                                                        <option value="">Selecione...</option>
                                                        <option value="1" <?php
                                                        if ((int) $prod->unidade === 1) {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>>Unidade</option>
                                                        <option value="2"<?php
                                                        if ((int) $prod->unidade === 2) {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>>Caixa</option>
                                                        <option value="3"<?php
                                                        if ((int) $prod->unidade === 3) {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>>Kilo</option>
                                                        <option value="4"<?php
                                                        if ((int) $prod->unidade === 4) {
                                                            echo 'selected="selected"';
                                                        }
                                                        ?>>Metro</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="valormercadoria" class="col-sm-2 control-label">Valor Mercadoria (R$)</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="valormercadoria"
                                                           name="valormercadoria" placeholder="Informe o valor da mercadoria" value="<?php echo $prod->valormercadoria; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="valorvenda" class="col-sm-2 control-label">Valor para Venda (R$)</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="valorvenda"
                                                           name="valorvenda" placeholder="Informe o valor para venda" value="<?php echo $prod->valorvenda; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="qtdeestoque" class="col-sm-2 control-label">Quantidade em Estoque</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="qtdeestoque"
                                                           name="qtdeestoque" placeholder="Informe a quantidade em Estoque" value="<?php echo $prod->qtdeestoque; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="descontopermitido" class="col-sm-2 control-label">Desconto Máximo Permitido (%)</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="descontopermitido"
                                                           name="descontopermitido"
                                                           placeholder="Informe o valor máximo de desconto permitido" value="<?php echo $prod->descontopermitido; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="alertaestoque" class="col-sm-2 control-label">Estoque minimo para alerta</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="alertaestoque"
                                                           name="alertaestoque"
                                                           placeholder="Informe o estoque minimo para alerta do sistema" value="<?php echo $prod->alertaestoque; ?>">
                                                </div>
                                            </div>
                                            <div class="fform-group row">
                                                <label for="qtdevendaminima" class="col-sm-2 control-label">Quantidade minima para venda</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="qtdevendaminima"
                                                           name="qtdevendaminima"
                                                           placeholder="Informe a quantidade minima para venda" value="<?php echo $prod->qtdevendaminima; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="qtdevalorminimo" class="col-sm-2 control-label">Valor minimo para venda</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="qtdevalorminimo"
                                                           name="qtdevalorminimo"
                                                           placeholder="Informe o valor minimo para venda" value="<?php echo $prod->qtdevalorminimo; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="codigoean" class="col-sm-2 control-label">Código EAN</label>

                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" id="codigoean"
                                                           name="codigoean"
                                                           placeholder="Informe o código EAN do produto" value="<?php echo $prod->codigoean; ?>" onkeyup="geracodigobarra();">
                                                </div>
                                            </div>
                                            <div id="buttons" class="d-flex justify-content-end">
                                                <div class="col-sm-4">
                                                    <button type="submit" class="btn btn-primary" style="width: 100%">Atualizar Produto</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        </section>
    </div>
</div>

<script src="../assets/js/plugins/jquery/jquery.min.js"></script>
<script>
                                                               var base_url = '<?php echo base_url() ?>';
                                                               $(document).ready(function () {

                                                               });
                                                               function buscaInfo(perfil) {
                                                                   var perfil = perfil;
                                                                   var url = base_url + "home/buscausuarioperfil";
                                                                   $.post(url, {
                                                                       perfil: perfil
                                                                   }, function (data) {
                                                                       $('#resultado').html(data);
                                                                   });
                                                               }
</script>