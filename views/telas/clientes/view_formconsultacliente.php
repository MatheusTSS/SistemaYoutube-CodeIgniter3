<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta de Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                        <li class="breadcrumb-item active">Consulta de Clientes</li>
                    </ol>
                </div>        
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Informe os Dados do Cliente</h3>
                        </div>
                        <?php
                        if (isset($msg)) {
                            echo '<div class="card-header">' . $msg . '</div>';
                        }
                        ?>
                        <div class="card-body">
                            <form role="form" action="consultacliente" method="post" id="formconsultacliente" class="form-horizontal">
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
                                                   name="cpf" placeholder="Informe o CPF" value="<?php echo set_value('cpf'); ?>">
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
                                <div id="buttons" class="d-flex justify-content-end">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn btn-primary" style="width: 100%">Consultar Cliente</button>
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