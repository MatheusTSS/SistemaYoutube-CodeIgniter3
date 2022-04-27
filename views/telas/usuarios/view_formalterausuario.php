<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Alteração de Informações do Usuário</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                        <li class="breadcrumb-item active">Usuários</li>
                        <li class="breadcrumb-item active">Alteração de Informações do Usuário</li>
                    </ol>
                </div>        
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title">Informe os Dados do Usuário</h3>
                        </div>
                        <?php
                        if (isset($msg)) {
                            echo '<div class="card-header">' . $msg . '</div>';
                        }
                        ?>
                        <div class="card-body">
                            <form role="form" action="atualizausuario" method="post" id="formcalterausuario" class="form-horizontal">
                                <div class="card-body">
                                    <?php
                                    $nome = '';
                                    $login = '';
                                    $email = '';
                                    if (isset($resultadoUsuarioEspecifico)) {
                                        foreach ($resultadoUsuarioEspecifico as $user) {
                                            $id = $user->id;
                                            $nome = $user->nome;
                                            $login = $user->login;
                                            $email = $user->email;
                                        }
                                    }
                                    ?>
                                    <div class="form-group row">
                                        <label for="nome" class="col-sm-2 col-form-label">Nome :</label>
                                        <input type="hidden" name="id" id="id" value="<?php echo set_value('id', $id); ?>" readonly="readonly">
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Informe o nome completo do usuário" value="<?php echo set_value('nome',$nome); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="login" class="col-sm-2 col-form-label">Login :</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="login" name="login" placeholder="Informe o nome completo do usuário" value="<?php echo set_value('login',$login); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email :</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Informe o e-mail de contato" value="<?php echo set_value('email',$email); ?>">
                                        </div>
                                    </div>
                                    <div id="buttons" class="d-flex justify-content-end">
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary" form="formcalterausuario" style="width: 100%">Atualizar Usuário</button>
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
