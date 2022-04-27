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
                    <h1 class="m-0">Lista de Produtos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Produtos</li>
                        <li class="breadcrumb-item active">Lista de Produtos</li>
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
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:24px">&nbsp;</th>
                                        <th>Produto</th>
                                        <th>Unidade</th>
                                        <th>Estoque</th>
                                        <th>Valor Venda</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($resultadoProduto)) {
                                        foreach ($resultadoProduto as $produto) {
                                            ?>
                                            <tr>
                                                <td><a href="alteraproduto?id=<?php echo $produto->id; ?>" title="Editar"><i class="fas fa-edit"></i></a></td>
                                                <td><?php echo $produto->descricaoproduto; ?></td>
                                                <td><?php echo $produto->unidade; ?></td>
                                                <td><?php echo $produto->qtdeestoque; ?></td>
                                                <td><?php echo $produto->valorvenda; ?></td>
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
</script>
