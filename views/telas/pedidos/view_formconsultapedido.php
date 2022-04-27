<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Consulta dos Pedidos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Pedidos</li>
                        <li class="breadcrumb-item active">Consulta dos Pedidos</li>
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
                        ?>
                        <div class="card-body">
                            <form role="form" action="consultarpedido" method="post"
                                  class="form-horizontal">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="codigopedido" class="col-sm-2 control-label">Código do Pedido :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="codigopedido" name="codigopedido"
                                                   placeholder="Informe o Código do Pedido" value="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nome" class="col-sm-2 control-label">Nome do Cliente :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nome" name="nome"
                                                   placeholder="Informe o Nome do Cliente (Opcional)" value="">
                                        </div>
                                    </div>
                                    <div id="buttons" class="d-flex justify-content-end">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary" style="width: 100%">Consultar Pedido</button>
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

