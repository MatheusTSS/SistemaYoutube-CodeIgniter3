<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
<link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="../assets/css/plugins/fontawesome/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="../assets/css/datatables/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/css/datatables/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="../assets/css/datatables/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="../assets/css/adminlte/adminlte.min.css">

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Lista dos Pedidos Efetuados</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Pedidos</li>
                        <li class="breadcrumb-item active">Lista dos Pedidos Efetuados</li>
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
                        if ($this->session->flashdata('msg')) {
                            echo '<div class="box-header with-border">' . $this->session->flashdata('msg') . '</div>';
                        }
                        ?>

                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:24px">&nbsp;</th>
                                        <th>C??digo Pedido :</th>
                                        <th>Cliente :</th>
                                        <th>Usu??rio :</th>
                                        <th>Valor L??quido(R$) :</th>
                                        <th>Valor Bruto(R$) :</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ((isset($pedidos)) && (!empty($pedidos))) {
                                        foreach ($pedidos as $ped) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <a href="#" onclick="alterarpedido(<?php echo $ped->pedidoid; ?>)">
                                                        <i class="fas fa-retweet"></i>
                                                    </a>
                                                </td>
                                                <td><?php echo $ped->codigopedido; ?></td>
                                                <td><?php echo $ped->nomefantasia; ?></td>
                                                <td><?php echo $ped->nome; ?></td>
                                                <td><?php echo $ped->valorliquido; ?></td>
                                                <td><?php echo $ped->valorbruto; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
</div>
<form name="frmemissaopedido" id="frmemissaopedido" action="emissaopedido" method="post">
    <input type="hidden" name="pedidoid" id="pedidoid" readonly="readonly" required="required">
</form>


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
                                                    var base_url = '<?php echo base_url() ?>';
                                                    $(document).ready(function () {

                                                    });
                                                    $(function () {
                                                        $('#example1').DataTable({
                                                            "paging": true,
                                                            "lengthChange": false,
                                                            "searching": false,
                                                            "ordering": true,
                                                            "info": true,
                                                            "autoWidth": false
                                                        });
                                                    });
                                                    function alterarpedido(id) {
                                                        swal({
                                                            title: "Emiss??o de Pedido",
                                                            text: "Deseja realmente efetuar a emiss??o do pedido ID: " + id,
                                                            type: "success",
                                                            showCancelButton: true,
                                                            confirmButtonClass: "btn-success",
                                                            confirmButtonText: "Sim, emitir pedido!",
                                                            cancelButtonText: "Cancelar!",
                                                            closeOnConfirm: false,
                                                            closeOnCancel: false
                                                        },
                                                                function (isConfirm) {
                                                                    if (isConfirm) {
                                                                        $('#pedidoid').val(id);
                                                                        $('#frmemissaopedido').submit();
                                                                    } else {
                                                                        swal("Emiss??o de Pedido", "A emiss??o do pedido foi cancelada com sucesso", "error");
                                                                    }
                                                                }
                                                        );
                                                    }

</script>