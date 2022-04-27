<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Requisição AJAX</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Requisição JQUERY </li>
                    </ol>
                </div>        
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Perfil</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <select class="form-control" onchange="buscaInfo(this.value)">
                                    <option>Selecione...</option>
                                    <?php
                                    if (isset($resultadoPerfil)) {
                                        foreach ($resultadoPerfil as $perfil) {
                                            echo '<option value = "' . $perfil->perfilid . '">' . $perfil->descricao . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Resultado AJAX</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <textarea class="form-control" rows="3" id = "resultado" name="resultado" placeholder="Selecione o perfil para mais informações..."></textarea>
                            </div>
                        </div>
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
	function buscaInfo(perfil){
		var perfil = perfil;
		var url = base_url + "home/buscausuarioperfil";
        $.post(url, {
        	perfil: perfil
        }, function (data) {
            $('#resultado').html(data);
        });
	}
</script>