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
                    <h1 class="m-0">Lista de Clientes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Clientes</li>
                        <li class="breadcrumb-item active">Lista de Clientes</li>
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

                        <div class="box-body">
                            <form role="form" name="formulariocliente" action="alteracliente" method="post" id="formulariocliente" class="form-horizontal">
                                <input name="idcliente" id="idcliente" type="hidden" value="" readonly="readonly">
                            </form>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:24px">&nbsp;</th>
                                        <th>Nome do Cliente </th>
                                        <th>E-mail</th>
                                        <th>Estado</th>
                                        <th style="width:1px;">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ((isset($clientelista)) && (!empty($clientelista))) {
                                        foreach ($clientelista as $cliente) {
                                            ?>
                                            <tr>
                                                <td><a href="#" onclick="consultacliente('<?php echo $cliente->id; ?>')"><i class="fa fa-edit"></i></a></td>
                                                <td><?php echo $cliente->nomefantasia; ?></td>
                                                <td><?php echo $cliente->email; ?></td>
                                                <td><?php echo $cliente->estado; ?></td>
                                                <td><?php
                                                    if ((int) $cliente->status === 1) {
                                                        echo '<i class="fa fa-circle 2x" style="color: green;">';
                                                    } else {
                                                        if ((int) $cliente->status === 0) {
                                                            echo '<i class="fa fa-circle 2x" style="color: red;">';
                                                        } else {
                                                            echo '<i class="fa fa-circle 2x" style="color: yellow;">';
                                                        }
                                                    }
                                                    ?></td>
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

                                                        function consultacliente(id) {
                                                            $('#idcliente').val(id);
                                                            $('#formulariocliente').submit();
                                                        }

</script>
