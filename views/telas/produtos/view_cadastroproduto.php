<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cadastro de Produto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Produtos</li>
                        <li class="breadcrumb-item active">Cadastro de Produto</li>
                    </ol>
                </div>        
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Informe os dados do produto  </h3>
                        </div>
                        <?php
                        if (isset($msg)) {
                            echo '<div class="card-header">' . $msg . '</div>';
                        }
                        ?>
                        <div class="card-body">
                            <form role="form" action="cadastraproduto" method="post" id="formcadastraproduto" class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="descricaoproduto" class="col-sm-2 control-label">Descrição do Produto :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="descricaoproduto" name="descricaoproduto"
                                                   placeholder="Informe a Descrição do Produto" value="<?php echo set_value('descricaoproduto'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="unidade" class="col-sm-2 col-form-label">Unidade de Venda :</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="unidade" name="unidade">
                                                <option value="">Selecione...</option>
                                                <option value="1">Unidade</option>
                                                <option value="2">Caixa</option>
                                                <option value="3">Quilo</option>
                                                <option value="4">Metro</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valormercadoria" class="col-sm-2 control-label">Valor Mercadoria (R$) :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="valormercadoria" name="valormercadoria"
                                               placeholder="Informe o Valor da Mercadoria" value="<?php echo set_value('valormercadoria'); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valorvenda" class="col-sm-2 control-label">Valor para Venda (R$) :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="valorvenda" name="valorvenda"
                                               placeholder="Informe o Valor para Venda" value="<?php echo set_value('valorvenda'); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="qtdeestoque" class="col-sm-2 control-label">Quant. em Estoque :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="qtdeestoque" name="qtdeestoque"
                                               placeholder="Informe a Quantidade em Estoque" value="<?php echo set_value('qtdeestoque'); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="descontopermitido" class="col-sm-2 control-label">Desconto Permitido (%) :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="descontopermitido" name="descontopermitido"
                                               placeholder="Informe o Valor Máximo de Desconto Permitido" value="<?php echo set_value('descontopermitido'); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="alertaestoque" class="col-sm-2 control-label">Alerta Estoque :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="alertaestoque" name="alertaestoque"
                                               placeholder="Informe o Estoque Mínimo para Alerta do Sistema" value="<?php echo set_value('alertaestoque'); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="qtdevendaminima" class="col-sm-2 control-label">Quant. Mínima Venda :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="qtdevendaminima" name="qtdevendaminima"
                                               placeholder="Informe a Quantidade Mínima para Venda" value="<?php echo set_value('qtdevendaminima'); ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="qtdevalorminimo" class="col-sm-2 control-label">Valor Mínimo Venda (R$) :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="qtdevalorminimo" name="qtdevalorminimo"
                                               placeholder="Informe o Valor Mínimo para Venda" value="<?php echo set_value('qtdevalorminimo'); ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="codigoean" class="col-sm-2 control-label">Código EAN :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="codigoean" name="codigoean"
                                               placeholder="Informe o Código EAN do Produto" value="<?php echo set_value('codigoean'); ?>" onkeyup="geracodigobarra();">
                                    </div>
                                    <div class="form-group row">
                                        <span id="codigobarra" name="codigobarra"></span>
                                    </div>
                                </div>
                                <div id="buttons" class="d-flex justify-content-end">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">Cadastrar Produto</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
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

                                                   function geracodigobarra() {
                                                       var codigoean = $('#codigoean').val();
                                                       var url = base_url + "home/geracodigobarras";
                                                       $.post(url, {
                                                           codigoean: codigoean
                                                       }, function (data) {
                                                           $('#codigobarra').html('<img src=' + data + '>');
                                                       });
                                                   }
</script>
