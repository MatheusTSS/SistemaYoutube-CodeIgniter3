<?php
$pedidoid = '';
$clienteid = '';
$codigopedido = '';
$valormercadoria = '';
$valorbruto = '';

if ((isset($pedido)) && (!empty($pedido))) {
    foreach ($pedido as $p) {
        $pedidoid = $p->pedidoid;
        $clienteid = $p->clienteid;
        $codigopedido = $p->codigopedido;
        $valormercadoria = $p->valorliquido;
        $valorbruto = $p->valorbruto;
    }
}

$itens = array(); 
if ((isset($pedidoitens)) && (!empty($pedidoitens))) {
    foreach ($pedidoitens as $pi) {
        $itens[$pi->produtoid]['quantidade'] = $pi->quantidade;
        $itens[$pi->produtoid]['desconto'] = $pi->desconto;
    }
}
?>

<style>
    .dataTables_filter {
        position: absolute;
        right: 0px !important;
        margin-right: 15px;
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alteração de Pedido</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Pedidos</li>
                        <li class="breadcrumb-item active">Alteração de Pedido</li>
                    </ol>
                </div>        
            </div>
            <form role="form" action="novopedido" method="post" name="formalterapedido" id="alterarpedido" class="form-horizontal">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-warning">
                            <?php
                            if (isset($msg)) {
                                echo '<div class="card-header">' . $msg . '</div>';
                            }
                            ?>
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="clienteid" class="col-sm-2 control-label"> Cliente ID :</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="clienteid" name="clienteid"
                                                   placeholder="Informe o ID do Cliente" value="<?php echo $clienteid; ?>" readonly="readonly" tabindex="-1">
                                            <input type="hidden" class="form-control" id="tabledata" name="tabledata"
                                                   value="" readonly="readonly" tabindex="-1">
                                            <input type="hidden" class="form-control" id="pedidoid" name="pedidoid"
                                                   value="<?php echo $pedidoid; ?>" readonly="readonly" tabindex="-1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cliente" class="col-sm-2 col-form-label">Cliente :</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cliente" name="cliente" onchange="carregaid(this.value)">
                                                <option value="">Selecione...</option>
                                                <?php
                                                if ((isset($resultadoClientes)) && (!empty($resultadoClientes))) {
                                                    foreach ($resultadoClientes as $cli) {
                                                        if ($clienteid === $cli->id) {
                                                            echo '<option value="' . $cli->id . '"selected="selected">' . $cli->nomefantasia . '</option>';
                                                        } else {
                                                            echo '<option value="' . $cli->id . '">' . $cli->nomefantasia . '</option>';
                                                        }
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="codigopedido" class="col-sm-2 control-label">Código do Pedido :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="codigopedido" name="codigopedido" 
                                               value="<?php echo set_value('codigopedido', $codigopedido); ?>"readonly="readonly" tabindex="-1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valormercadoria" class="col-sm-2 control-label">Valor Mercadoria (R$) :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="valormercadoria" name="valormercadoria"
                                               placeholder="R$ 0.00" value="<?php echo $valormercadoria; ?>" readonly="readonly" tabindex="-1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="valorbruto" class="col-sm-2 control-label">Valor Bruto (R$) :</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="valorbruto" name="valorbruto"
                                               placeholder="R$ 0.00" value="<?php echo $valorbruto; ?>" readonly="readonly" tabindex="-1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <input type="button" value="Salvar Pedido" onclick="salvapedido();">
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card card-success">
                <?php
                if (isset($msg)) {
                    echo '<div class="card-header">' . $msg . '</div>';
                }
                ?>
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Cód. Produto </th>
                                <th>Descrição</th>
                                <th style="width:10px">Qtde</th>
                                <th style="width:10px">Desconto</th>
                                <th>Vl. Mercadoria</th>
                                <th>Vl. Venda</th>
                                <th>Qtde. Estoque</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ((isset($produtos)) && (!empty($produtos))) {
                                $totalitens = 0;
                                foreach ($produtos as $produtos) {
                                    $totalitens = (int) $totalitens + 1;
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $produtos->id; ?>
                                            <input type="hidden" name="CODE<?php echo $totalitens; ?>" id="CODE<?php echo $totalitens; ?>" value="<?php echo $produtos->id; ?>">
                                        </td>
                                        <td><?php echo $produtos->descricaoproduto; ?></td>
                                        <td>
                                            <?php
                                            if (array_key_exists($produtos->id, $itens)) {
                                                ?>
                                                <input type="text" style="width: 60px;" name="QTDE<?php echo $totalitens; ?>" id="QTDE<?php echo $totalitens; ?>" value="<?php echo $itens[$produtos->id]['quantidade']; ?>" onfocus="limpacampo(this.id)" onblur="verificanulo(this.id)" onkeyup="calcula()">
                                                <?php
                                            } else {
                                                ?>
                                                <input type="text" style="width: 60px;" name="QTDE<?php echo $totalitens; ?>" id="QTDE<?php echo $totalitens; ?>" value="0" onfocus="limpacampo(this.id)" onblur="verificanulo(this.id)" onkeyup="calcula()">
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <?php
                                        if (array_key_exists($produtos->id, $itens)) {
                                            if ((int) $produtos->descontopermitido > 0):
                                                echo '<td><input type="text" style="width: 60px;" name="DESC' . $totalitens . '" id="DESC' . $totalitens . '" value="' . $itens[$produtos->id]['desconto'] . '"></td>';
                                            else:
                                                echo '<td><input type="text" style="width: 60px; border:0;" name="DESC' . $totalitens . '" id="DESC' . $totalitens . '" value="' . $itens[$produtos->id]['desconto'] . '" readonly="readonly" tabindex="-1"></td>';
                                            endif;
                                        } else {
                                            if ((int) $produtos->descontopermitido > 0):
                                                echo '<td><input type="text" style="width: 60px;" name="DESC' . $totalitens . '" id="DESC' . $totalitens . '" value="0"></td>';
                                            else:
                                                echo '<td><input type="text" style="width: 60px; border:0;" name="DESC' . $totalitens . '" id="DESC' . $totalitens . '" value="0" readonly="readonly" tabindex="-1"></td>';
                                            endif;
                                        }
                                        ?>   
                                        <td><input type="text" style="border:0;" name="MERC<?php echo $totalitens; ?>" id="MERC<?php echo $totalitens; ?>" value="<?php echo $produtos->valormercadoria; ?>" readonly="readonly" tabindex="-1"></td>
                                        <td><input type="text" style="border:0;" name="VEND<?php echo $totalitens; ?>" id="VEND<?php echo $totalitens; ?>" value="<?php echo $produtos->valorvenda; ?>" readonly="readonly" tabindex="-1"></td>
                                        <td><?php echo $produtos->qtdeestoque; ?></td>

                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                    <!--<input type="hidden" name="totalitens" id="totalitens" value="<?php echo $totalitens; ?>">-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- jQuery -->
<script src="../assets/js/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/js/plugins/bootstrap/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../assets/js/datatables/dataTables.responsive.min.js"></script>
<script src="../assets/js/datatables/responsive.bootstrap4.min.js"></script>
<script src="../assets/js/datatables/dataTables.buttons.min.js"></script>
<script src="../assets/js/datatables/buttons.bootstrap4.min.js"></script>
<script src="../assets/js/plugins/jszip/jszip.min.js"></script>
<script src="../assets/js/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../assets/js/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../assets/js/datatables/buttons.html5.min.js"></script>
<script src="../assets/js/datatables/buttons.print.min.js"></script>
<script src="../assets/js/datatables/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte/adminlte.min.js"></script>
<script>


                                                    table = $('#example1').DataTable({
                                                        "bLengthChange": true,
                                                        "info": true,
                                                        "bFilter": true,
                                                        responsive: true,
                                                        "language": {
                                                            "lengthMenu": "Exibindo _MENU_ produtos por pagina",
                                                            "zeroRecords": "Nenhum produto encontrado",
                                                            "info": "Exibindo página _PAGE_ de _PAGES_. Total de produtos: _TOTAL_",
                                                            "infoEmpty": "Nenhum produto localizado",
                                                            "infoFiltered": "(Filtrando um total de _MAX_ produtos)",
                                                            "decimal": "",
                                                            "emptyTable": "Nenhum produto localizado",
                                                            "infoPostFix": "",
                                                            "thousands": ",",
                                                            "bLengthChange": true,
                                                            "displayLength": 10,
//                                                            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
                                                            "loadingRecords": "Carregando...",
                                                            "processing": "Processando...",
                                                            "search": "Filtro:",
                                                            "sPaginationType": "full_numbers",
                                                            "paginate": {
                                                                "first": "Primeira",
                                                                "last": "Última",
                                                                "next": "Próxima",
                                                                "previous": "Anterior"
                                                            },
                                                            "aria": {
                                                                "sortAscending": ": activate to sort column ascending",
                                                                "sortDescending": ": activate to sort column descending"
                                                            }
                                                        },
                                                    });
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

                                                    function carregaid(idcliente) {
                                                        $('#clienteid').val(idcliente);
                                                    }

                                                    function limpacampo(id) {
                                                        var vlcampo = $('#' + id).val();
                                                        if (vlcampo > 0) {
                                                        } else {
                                                            $('#' + id).val('');
                                                        }
                                                    }


                                                    function verificanulo(id) {
                                                        var vlcampo = $('#' + id).val();
                                                        if (vlcampo === '') {
                                                            $('#' + id).val(0);
                                                        }
                                                    }

                                                    function calcula(id) {
                                                        debugger;
                                                        var totalitens = '<?php echo $totalitens; ?>';
                                                        var vlmercardoria = 0;
                                                        var vlbruto = 0;
                                                        var i;
                                                        for (i = 1; i <= totalitens; i++) {
                                                            var campoqtde = 'QTDE' + i;
                                                            var vlqtde = $('#' + campoqtde).val();
                                                            var campodesc = 'DESC' + i;
                                                            var vldesc = $('#' + campodesc).val();
                                                            var campovend = 'VEND' + i;
                                                            var vlvend = $('#' + campovend).val();
                                                            if ((vldesc > 0) && (vlqtde > 0)) {
                                                                vlmercardoria = vlmercardoria + (vlqtde * ((vldesc * vlvend) / 100));
                                                            } else {
                                                                vlmercardoria = vlmercardoria + (vlqtde * vlvend);
                                                            }
                                                            vlbruto = vlbruto + (vlqtde * vlvend);
                                                        }

                                                        $('#valormercadoria').val(vlmercardoria);
                                                        $('#valorbruto').val(vlbruto);
                                                    }
                                                    function salvapedido() {
                                                        var frm_data = table.$('input[type="text"],input[type = "hidden"]').serializeArray();
                                                        var codigos = '';
                                                        var quantidades = '';
                                                        var descontos = '';
                                                        $.each(frm_data, function (key, val) {
                                                            var validacampo = val.name.substring(0, 4);
                                                            if (validacampo === 'CODE') {
                                                                quantidades += val.name + ':' + val.value + ';';
                                                            }
                                                            if (validacampo === 'QTDE') {
                                                                codigos += val.name + ':' + val.value + ';';
                                                            }
                                                            if (validacampo === 'DESC') {
                                                                descontos += val.name + ':' + val.value + ';';
                                                            }
                                                        });
                                                        $("#tabledata").val(codigo + '||' + quantidades + '||' + descontos);
                                                        $('#formalterapedido').submit();
                                                    }
</script>
