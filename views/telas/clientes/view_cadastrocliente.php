<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Cadastro de Cliente</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                        <li class="breadcrumb-item active">Cadastro de Clientes</li>
                    </ol>
                </div>        
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Informe os dados do cliente</h3>
                        </div>
                        <?php
                        if (isset($msg)) {
                            echo '<div class="card-header">' . $msg . '</div>';
                        }
                        ?>
                        <div class="card-body">
                            <form role="form" action="cadastracliente" method="post" id="formcadastracliente" class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nomefantasia" class="col-sm-2 control-label">Nome Fantasia :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nomefantasia" name="nomefantasia"
                                                   placeholder="Informe o Nome Fantasia" value="<?php echo set_value('nomefantasia'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="razaosocial" class="col-sm-2 control-label">Razão Social :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="razaosocial"
                                                   name="razaosocial" placeholder="Informe a Razão Social" value="<?php echo set_value('razaosocial'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tipocliente" class="col-sm-2 control-label">Tipo Cliente :</label>
                                        <div class="col-sm-5">
                                            <input type="radio" class="flat-red" id="cnpj" name="cnpj"><label for="tipocliente" class="control-label">&nbsp;&nbsp;Pessoa Jurídica</label>
                                        </div>
                                        <div class="col-sm-5">
                                            <input type="radio" class="flat-red" id="cnpj" name="cnpj"><label for="tipocliente" class="control-label">&nbsp;&nbsp;Pessoa Física</label>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cnpj" class="col-sm-2 control-label">CNPJ :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="cnpj"
                                                   name="cnpj" placeholder="Informe o CNPJ" value="<?php echo set_value('cnpj'); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cpf" class="col-sm-2 control-label">CPF :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="cpf"
                                                   name="cpf" placeholder="Informe o CPF" value="<?php echo set_value('cpf'); ?>" readonly="readonly">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="telefone" class="col-sm-2 control-label">Telefone Comercial :</label>

                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="telefone"
                                                   name="telefone"
                                                   placeholder="Informe o Telefone Comercial" value="<?php echo set_value('telefone'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="celular" class="col-sm-2 control-label">Telefone Celular :</label>

                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="celular"
                                                   name="celular"
                                                   placeholder="Informe o Telefone Celular" value="<?php echo set_value('celular'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 control-label">E-mail :</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email"
                                                   name="email"
                                                   placeholder="Informe o E-mail" value="<?php echo set_value('email'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="endereco" class="col-sm-2 control-label">Endereço  Completo :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="endereco"
                                                   name="endereco"
                                                   placeholder="Informe o Endereço" value="<?php echo set_value('endereco'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="complemento" class="col-sm-2 control-label">Complemento :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="complemento"
                                                   name="complemento"
                                                   placeholder="Informações Complementares" value="<?php echo set_value('complemento'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="bairro" class="col-sm-2 control-label">Bairro :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="bairro"
                                                   name="bairro"
                                                   placeholder="Informe o Bairro" value="<?php echo set_value('bairro'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cidade" class="col-sm-2 control-label">Cidade :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="cidade"
                                                   name="cidade"
                                                   placeholder="Informe a Cidade" value="<?php echo set_value('cidade'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="estado" class="col-sm-2 control-label">Estado :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="estado"
                                                   name="estado"
                                                   placeholder="Informe o Estado" value="<?php echo set_value('estado'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="cep" class="col-sm-2 control-label">CEP :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="cep"
                                                   name="cep"
                                                   placeholder="Informe o CEP" value="<?php echo set_value('cep'); ?>">
                                        </div>
                                    </div>
                                    <div id="buttons" class="d-flex justify-content-end">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary" form="formcadastracliente" style="width: 100%">Cadastrar Cliente</button>
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