<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller { // Controlador HOME - "MEIO de Campo do Sistema

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('form');
        date_default_timezone_set('America/Sao_Paulo');
    }

    function index() {
        redirect('login');
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('home', 'refresh');
    }

    function dashboard() {
        $this->load->view('view_home');
    }

    //
    //              Requisição AJAX                 //
    //
    function requisicaoajax() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;
            $dados ['tela'] = 'view_requisicaojquery';
            $this->load->view('view_home', $dados);
        } else {
            redirect('home/login', 'refresh');
        }
    }

    //
    //              Usuários                         //
    //
    function cadastrausuario() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                if ((!empty(trim($this->input->post('nome')))) ||
                        (!empty(trim($this->input->post('login')))) ||
                        (!empty(trim($this->input->post('email')))) ||
                        (!empty(trim($this->input->post('senha')))) ||
                        (!empty(trim($this->input->post('perfilid'))))
                ) {
                    $dadosusuario ['nome'] = $this->input->post('nome');
                    $dadosusuario ['login'] = $this->input->post('login');
                    $dadosusuario ['email'] = $this->input->post('email');
                    $dadosusuario ['senha'] = $this->input->post('senha');
                    $dadosusuario ['datacadastro'] = date('Y-m-d H:i:s');
                    $dadosusuario ['perfilid'] = $this->input->post('perfilid');
                    $dadosusuario ['status'] = 1;

                    $this->load->model('model_usuario');
                    $resultadocadastrousuario = $this->model_usuario->cadastrausuario($dadosusuario);

                    if ($resultadocadastrousuario) {
                        redirect('home/listausuario', 'refresh');
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao cadastrar o usuário! Atualize a página e tente novamente';
                        $dados ['tela'] = 'usuarios/view_cadastrousuario';
                    }
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'usuarios/view_cadastrousuario';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['tela'] = 'usuarios/view_cadastrousuario';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function listausuario() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_usuario');
            $resultadoUsuarios = $this->model_usuario->buscaUsuarios();
            $dados ['resultadoUsuario'] = $resultadoUsuarios;

            $dados ['tela'] = 'usuarios/view_listausuario';
            $this->load->view('view_home', $dados);
        }
    }

    function consultausuario() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_usuario');
            if ($this->input->post()) {
                if ((!empty(trim($this->input->post('nome')))) ||
                        (!empty(trim($this->input->post('login')))) ||
                        (!empty(trim($this->input->post('email'))))) {
                    $dadosusuario ['nome'] = $this->input->post('nome');
                    $dadosusuario ['login'] = $this->input->post('login');
                    $dadosusuario ['email'] = $this->input->post('email');

                    $this->load->model('model_usuario');
                    $resultadousuario = $this->model_usuario->consultausuario($dadosusuario);
                    if ($resultadousuario) {
                        $dados ['resultadoUsuario'] = $resultadousuario;
                        $dados ['tela'] = 'usuarios/view_listausuario';
                        $this->load->view('view_home', $dados);
                    } else {
                        $dados ['msg'] = 'Nenhum Usuário localizado para os dados informados! Tente novamente';
                        $dados ['tela'] = 'usuarios/view_listausuario';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'usuarios/view_formconsultausuario';
                    $this->load->view('view_home', $dados);
                }
            } else if ($this->input->get()) {
                if ($this->input->get('id')) {
                    $id = (int) $this->input->get('id');

                    $this->load->model('model_usuario');
                    $resultadousuarioespecifico = $this->model_usuario->consultausuarioespecifico($id);
                    if ($resultadousuarioespecifico) {
                        $dados ['resultadoUsuarioEspecifico'] = $resultadousuarioespecifico;
                        $dados ['tela'] = 'usuarios/view_formalterausuario';
                        $this->load->view('view_home', $dados);
                    } else {
                        $dados ['msg'] = 'Nenhum Usuário localizado para os dados informados! Tente novamente';
                        $dados ['tela'] = 'usuarios/view_listausuario';
                        $this->load->view('view_home', $dados);
                    }
                }
            } else {
                $dados ['tela'] = 'usuarios/view_formconsultausuario';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function atualizausuario() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                if ((!empty(trim($this->input->post('id')))) &&
                        (!empty(trim($this->input->post('nome')))) &&
                        (!empty(trim($this->input->post('login')))) &&
                        (!empty(trim($this->input->post('email'))))) {
                    $dadosusuario ['id'] = $this->input->post('id');
                    $dadosusuario ['nome'] = $this->input->post('nome');
                    $dadosusuario ['login'] = $this->input->post('login');
                    $dadosusuario ['email'] = $this->input->post('email');
                    $this->load->model('model_usuario');
                    $resultadoatualizausuario = $this->model_usuario->atualizausuario($dadosusuario);
                    if ($resultadoatualizausuario) {
                        redirect('home/listausuario', 'refresh');
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao alterar o usuario! Atualize a página e tente novamente';
                        $dados ['tela'] = 'usuarios/view_formconsultausuario';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'usuarios/view_formconsultausuario';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['tela'] = 'usuarios/view_cadastrousuario';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function profile() {
        
    }

    //
    //              Perfil                          //
    //
    function buscausuarioperfil() {
        if ($this->session->userdata('logged_in')) {
            $option = "";

            if ($this->input->post()) {
                $perfil = $this->input->post('perfil    ');
                $this->load->model('model_usuario');
                $resultadoUsuarioPerfil = $this->model_usuario->buscaUsuarioPerfil($perfil);
                if ($resultadoUsuarioPerfil) {
                    foreach ($resultadoUsuarioPerfil as $Usuario) {
                        $option .= $Usuario->nome;
                    }
                } else {
                    $option .= "Nenhum Valor Encontrado";
                }
            }
        } else {
            $option .= "Nenhum Valor Encontrado";
        }
        echo $option;
    }

    //
    //              Clientes                         //
    //
    function cadastracliente() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {

                if (
                        (!empty(trim($this->input->post('nomefantasia')))) &&
                        (!empty(trim($this->input->post('razaosocial')))) &&
                        //((!empty(trim($this->input->post('cnpj')))) &&
                        // (!empty(trim($this->input->post('cpf'))))) &&
                        (!empty(trim($this->input->post('telefone')))) &&
                        (!empty(trim($this->input->post('celular')))) &&
                        (!empty(trim($this->input->post('email')))) &&
                        (!empty(trim($this->input->post('endereco')))) &&
                        (!empty(trim($this->input->post('complemento')))) &&
                        (!empty(trim($this->input->post('bairro')))) &&
                        (!empty(trim($this->input->post('cidade')))) &&
                        (!empty(trim($this->input->post('estado')))) &&
                        (!empty(trim($this->input->post('cep'))))
                ) {
                    $dadoscliente ['nomefantasia'] = $this->input->post('nomefantasia');
                    $dadoscliente ['razaosocial'] = $this->input->post('razaosocial');
                    $dadoscliente ['cnpj'] = $this->input->post('cnpj');
                    $dadoscliente ['cpf'] = $this->input->post('cpf');
                    $dadoscliente ['telefone'] = $this->input->post('telefone');
                    $dadoscliente ['celular'] = $this->input->post('celular');
                    $dadoscliente ['email'] = $this->input->post('email');
                    $dadoscliente ['endereco'] = $this->input->post('endereco');
                    $dadoscliente ['complemento'] = $this->input->post('complemento');
                    $dadoscliente ['bairro'] = $this->input->post('bairro');
                    $dadoscliente ['cidade'] = $this->input->post('cidade');
                    $dadoscliente ['estado'] = $this->input->post('estado');
                    $dadoscliente ['cep'] = $this->input->post('cep');

                    $this->load->model('model_cliente');
                    $resultadocadastrocliente = $this->model_cliente->cadastracliente($dadoscliente);

                    if ($resultadocadastrocliente) {
                        redirect('home/listacliente', 'refresh');
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao cadastrar o usuario! Atualize a página e tente novamente';
                        $dados ['tela'] = 'clientes/view_cadastrocliente';
                    }
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'clientes/view_cadastrocliente';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['tela'] = 'clientes/view_cadastrocliente';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function consultacliente() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                $dados['nomefantasia'] = $this->input->post('nomefantasia');
                $dados['razaosocial'] = $this->input->post('razaosocial');
                $dados['cnpj'] = $this->input->post('cnpj');
                $dados['cpf'] = $this->input->post('cpf');
                $dados['email'] = $this->input->post('email');
                if (
                        (!empty($dados['nomefantasia'])) ||
                        (!empty($dados['razaosocial'])) ||
                        (!empty($dados['cnpj'])) ||
                        (!empty($dados['cpf'])) ||
                        (!empty($dados['email']))
                ) {
                    $this->load->model('model_cliente');
                    $resultado = $this->model_cliente->buscaclientefiltro($dados);
                    if ($resultado) {
                        $dados['clientelista'] = $resultado;
                        $dados ['tela'] = 'clientes/view_listacliente';
                        $this->load->view('view_home', $dados);
                    } else {
                        $dados ['tela'] = 'clientes/view_formconsultacliente';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados ['tela'] = 'clientes/view_formconsultacliente';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['tela'] = 'clientes/view_formconsultacliente';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function listacliente() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                
            } else {
                $this->load->model('model_cliente');
                $resultadoClienteLista = $this->model_cliente->buscaclienteslista();
                $dados['clientelista'] = $resultadoClienteLista;
                $dados ['tela'] = 'clientes/view_listacliente';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function alteracliente() {
        if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;
            $this->load->model('model_cliente');

            if ($this->input->post()) {
                if ($this->input->post('nomefantasia')) {
                    if (
                            (!empty(trim($this->input->post('nomefantasia')))) &&
                            (!empty(trim($this->input->post('razaosocial')))) &&
                            //((!empty(trim($this->input->post('cnpj')))) && 
                            //(!empty(trim($this->input->post('cpf'))))) &&
                            (!empty(trim($this->input->post('telefone')))) &&
                            (!empty(trim($this->input->post('celular')))) &&
                            (!empty(trim($this->input->post('email')))) &&
                            (!empty(trim($this->input->post('endereco')))) &&
                            (!empty(trim($this->input->post('complemento')))) &&
                            (!empty(trim($this->input->post('bairro')))) &&
                            (!empty(trim($this->input->post('cidade')))) &&
                            (!empty(trim($this->input->post('estado')))) &&
                            (!empty(trim($this->input->post('cep'))))
                    ) {
                        $dadoscliente ['id'] = $this->input->post('clienteid');
                        $dadoscliente ['nomefantasia'] = $this->input->post('nomefantasia');
                        $dadoscliente ['razaosocial'] = $this->input->post('razaosocial');
                        $dadoscliente ['cnpj'] = $this->input->post('cnpj');
                        $dadoscliente ['cpf'] = $this->input->post('cpf');
                        $dadoscliente ['telefone'] = $this->input->post('telefone');
                        $dadoscliente ['celular'] = $this->input->post('celular');
                        $dadoscliente ['email'] = $this->input->post('email');
                        $dadoscliente ['endereco'] = $this->input->post('endereco');
                        $dadoscliente ['complemento'] = $this->input->post('complemento');
                        $dadoscliente ['bairro'] = $this->input->post('bairro');
                        $dadoscliente ['cidade'] = $this->input->post('cidade');
                        $dadoscliente ['estado'] = $this->input->post('estado');
                        $dadoscliente ['cep'] = $this->input->post('cep');

                        $resultadoClienteLista = $this->model_cliente->atualizacliente($dadoscliente);
                        if ($resultadoClienteLista) {
                            redirect('home/listacliente', 'refresh');
                        } else {
                            $dados['clientelista'] = $resultadoClienteLista;
                            $dados['msg'] = '<font color="red"><b>Ocorreu um erro ao atualizar o cliente...</b></font>';
                            $dados ['tela'] = 'clientes/view_formalteracliente';
                            $this->load->view('view_home', $dados);
                        }
                    } else {
                        $dados['msg'] = '<font color="red"><b>Preencha todos os campos para continuar...</b></font>';
                        $dados ['tela'] = 'clientes/view_formalteracliente';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $resultadoClienteLista = $this->model_cliente->buscaclienteslista();
                    $dados['clientelista'] = $resultadoClienteLista;
                    $dados ['tela'] = 'clientes/view_formalteracliente';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $clienteid = $this->input->post('idcliente');
                $resultadoClienteLista = $this->model_cliente->buscaclienteespecifico($clienteid);
                $dados['clientelista'] = $resultadoClienteLista;
                $dados ['tela'] = 'clientes/view_listacliente';
                $this->load->view('view_home', $dados);
            }
        }
    }

    //
    //              Produtos                     //
    //
    function cadastraproduto() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                if (
                        (!empty(trim($this->input->post('descricaoproduto')))) &&
                        (!empty(trim($this->input->post('unidade')))) &&
                        (!empty(trim($this->input->post('valormercadoria')))) &&
                        (!empty(trim($this->input->post('valorvenda')))) &&
                        (!empty(trim($this->input->post('qtdeestoque')))) &&
                        (!empty(trim($this->input->post('descontopermitido')))) &&
                        (!empty(trim($this->input->post('alertaestoque')))) &&
                        (!empty(trim($this->input->post('qtdevendaminima')))) &&
                        (!empty(trim($this->input->post('codigoean')))) &&
                        (!empty(trim($this->input->post('qtdevalorminimo'))))
                ) {
                    $dadosproduto ['descricaoproduto'] = $this->input->post('descricaoproduto');
                    $dadosproduto ['unidade'] = $this->input->post('unidade');
                    $dadosproduto ['valormercadoria'] = $this->input->post('valormercadoria');
                    $dadosproduto ['valorvenda'] = $this->input->post('valorvenda');
                    $dadosproduto ['qtdeestoque'] = $this->input->post('qtdeestoque');
                    $dadosproduto ['descontopermitido'] = $this->input->post('descontopermitido');
                    $dadosproduto ['alertaestoque'] = $this->input->post('alertaestoque');
                    $dadosproduto ['qtdevendaminima'] = $this->input->post('qtdevendaminima');
                    $dadosproduto ['qtdevalorminimo'] = $this->input->post('qtdevalorminimo');
                    $dadosproduto ['codigoean'] = $this->input->post('codigoean');

                    $this->load->model('model_produto');
                    $resultadocadastroproduto = $this->model_produto->cadastraproduto($dadosproduto);
                    if ($resultadocadastroproduto) {
                        redirect('home/listaproduto', 'refresh');
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao cadastrar o Produto! Atualize a página e tente novamente';
                        $dados ['tela'] = 'produtos/view_cadastroproduto';
                    }
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'produtos/view_cadastroproduto';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['tela'] = 'produtos/view_cadastroproduto';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function consultaproduto() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                $dados['descricaoproduto'] = $this->input->post('descricaoproduto');
                $dados['codigoean'] = $this->input->post('codigoean');

                if ((!empty($dados['descricaoproduto'])) || (!empty($dados['codigoean']))) {
                    $this->load->model('model_produto');
                    $resultadoprodutos = $this->model_produto->carregaprodutosfiltro($dados);
                    $dados ['resultadoProduto'] = $resultadoprodutos;
                    $dados ['telaativa'] = 'produtos';
                    $dados ['tela'] = 'produtos/view_listaproduto';
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['telaativa'] = 'produtos';
                    $dados ['tela'] = 'produtos/view_formconsultaproduto';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['telaativa'] = 'produtos';
                $dados ['tela'] = 'produtos/view_formconsultaproduto';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function listaproduto() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;
            $this->load->model('model_produto');
            if ($this->input->post()) {
                
            } else {

                $resultadoprodutos = $this->model_produto->carregaprodutos();
                $dados ['resultadoProduto'] = $resultadoprodutos;
                $dados ['tela'] = 'produtos/view_listaproduto';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function alteraproduto() {
        if ($this->session->userdata('logged_in')) { // VALIDA USU�RIO LOGADO
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {


                if (
                        (!empty(trim($this->input->post('produtoid')))) &&
                        (!empty(trim($this->input->post('descricaoproduto')))) &&
                        (!empty(trim($this->input->post('unidade')))) &&
                        (!empty(trim($this->input->post('valormercadoria')))) &&
                        (!empty(trim($this->input->post('valorvenda')))) &&
                        (!empty(trim($this->input->post('qtdeestoque')))) &&
                        //(!empty(trim($this->input->post('descontopermitido')))) &&
                        (!empty(trim($this->input->post('alertaestoque')))) &&
                        (!empty(trim($this->input->post('qtdevendaminima')))) &&
                        (!empty(trim($this->input->post('qtdevalorminimo')))) &&
                        (!empty(trim($this->input->post('codigoean'))))
                ) {
                    $dadoscliente ['id'] = $this->input->post('produtoid');
                    $dadoscliente ['descricaoproduto'] = $this->input->post('descricaoproduto');
                    $dadoscliente ['unidade'] = $this->input->post('unidade');
                    $dadoscliente ['valormercadoria'] = $this->input->post('valormercadoria');
                    $dadoscliente ['valorvenda'] = $this->input->post('valorvenda');
                    $dadoscliente ['qtdeestoque'] = $this->input->post('qtdeestoque');
                    if (!empty($this->input->post('descontopermitido'))) {
                        $dadoscliente ['descontopermitido'] = $this->input->post('descontopermitido');
                    } else {
                        $dadoscliente ['descontopermitido'] = 0;
                    }
                    $dadoscliente ['alertaestoque'] = $this->input->post('alertaestoque');
                    $dadoscliente ['qtdevendaminima'] = $this->input->post('qtdevendaminima');
                    $dadoscliente ['qtdevalorminimo'] = $this->input->post('qtdevalorminimo');
                    $dadoscliente ['codigoean'] = $this->input->post('codigoean');

                    $this->load->model('model_produto');
                    $resultadocadastroproduto = $this->model_produto->atualizaproduto($dadoscliente);

                    if ($resultadocadastroproduto) {
                        redirect('home/listaproduto', 'refresh');
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao cadastrar o Produto! Atualize a p�gina e tente novamente';
                        $dados ['tela'] = 'produtos/view_formalterarproduto';
                    }
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'produtos/view_formalterarproduto';
                    $this->load->view('view_home', $dados);
                }
            } else if ($this->input->get('id')) {
                $produtoid = $this->input->get('id');
                $this->load->model('model_produto');
                $dados ['resultadoProduto'] = $this->model_produto->carregaprodutosporid($produtoid);
                $dados ['tela'] = 'produtos/view_formalterarproduto';
                $this->load->view('view_home', $dados);
            } else {
                $dados ['tela'] = 'produtos/view_formalterarproduto';
                $this->load->view('view_home', $dados);
            }
        }
    }

    //
    //              Pedidos                      //
    //
    function novopedido() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $usuarioid = $session_data['UsuarioId'];
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            $this->load->model('model_cliente');
            $resultadoClientes = $this->model_cliente->carregaclientespedido();
            $dados ['resultadoClientes'] = $resultadoClientes;

            $this->load->model('model_produto');
            $resultadoProdutos = $this->model_produto->carregaprodutos();
            $dados ['resultadoProdutos'] = $resultadoProdutos;

            if ($this->input->post()) {

                if (
                        (!empty(trim($this->input->post('clienteid')))) &&
                        (!empty(trim($this->input->post('codigopedido'))))
                ) {
                    $dadospedido ['usuarioid'] = $usuarioid;
                    $dadospedido ['clienteid'] = $this->input->post('clienteid');
                    $dadospedido ['codigopedido'] = $this->input->post('codigopedido');
                    $dadospedido ['valorbruto'] = 0;
                    $dadospedido ['valorliquido'] = 0;
                    $this->load->model('model_pedido');
                    $resultadocadastropedido = $this->model_pedido->cadastrapedido($dadospedido);

                    if ($resultadocadastropedido) {
                        $totalitens = $this->input->post('totalitens');
                        $TodosItens = explode('||', $this->input->post('tabledata'));

                        $CodeItens = explode(';', $TodosItens[0]);
                        $QtdeItens = explode(';', $TodosItens[1]);
                        $DescItens = explode(';', $TodosItens[2]);

                        $quantidade = 0;
                        $valormercadoria = 0;
                        $valorvenda = 0;

                        $codigoproduto = '';
                        $quantidadeproduto = '';
                        $descontoproduto = '';

                        $this->load->model('model_produto');
                        $produtos = $this->model_produto->carregaprodutos();

                        foreach ($QtdeItens as $itens) {
                            $array = explode(':', $itens);
                            if ((!empty($array[1])) && ((int) $array[1] > 0)) {
                                $quantidadeproduto = $array[1];

                                $peganumqtde = str_replace('QTDE', '', $array[1]);

                                foreach ($DescItens as $desc) {
                                    $array2 = explode(':', $desc);
                                    if ($array2[0] === 'DESC' . $peganumqtde) {
                                        $descontoproduto = $array2[1];
                                    }
                                }
                                foreach ($CodeItens as $code) {
                                    $array3 = explode(':', $code);
                                    if ($array3[0] === 'CODE' . $peganumqtde) {
                                        $codigoproduto = $array3[1];
                                    }
                                }

                                foreach ($produtos as $prod) {
                                    if ($prod->id === $codigoproduto) {
                                        $quantidade = (int) $quantidade + (int) $quantidadeproduto;
                                        $valorvenda = $prod->valorvenda;
                                        $valormercadoria = (number_format($prod->valorvenda, 2, '.', ',') * (int) $quantidadeproduto);
                                        $valormercadoria = number_format($valormercadoria, 2, '.', ',') - ((number_format($valormercadoria, 2, '.', ',') * number_format($descontoproduto, 2, '.', ',')) / 100);
                                    }
                                }
                                $dadositens ['pedidoid'] = $resultadocadastropedido;
                                $dadositens ['clienteid'] = $this->input->post('clienteid');
                                $dadositens ['usuarioid'] = $usuarioid;
                                $dadositens ['produtoid'] = $codigoproduto;
                                $dadositens ['quantidade'] = $quantidadeproduto;
                                $dadositens ['valormercadoria'] = $valormercadoria;
                                $dadositens ['valorvenda'] = $valorvenda;
                                $dadositens ['desconto'] = $descontoproduto;

                                $resultadocadastroitem = $this->model_pedido->cadastraitens($dadositens);
                            }
                        }

                        if (!empty($resultadocadastroitem)) {
                            $dadospedido1 ['pedidoid'] = $dadositens ['pedidoid'];
                            $dadospedido1 ['valorbruto'] = $valormercadoria;
                            $dadospedido1 ['valorliquido'] = $valorvenda;
                            $this->load->model('model_pedido');
                            $resultadoatualizapedido = $this->model_pedido->atualizapedido($dadospedido1);

                            if ($resultadoatualizapedido) {
                                redirect('home/emissaopedido', 'refresh');
                            } else {
                                $dados ['msg'] = 'Ocorreu um erro ao atualizar o Pedido! Atualize a pagina e tente novamente';
                                $dados ['tela'] = 'pedidos/view_cadastropedido';
                            }
                        } else {
                            $dados ['msg'] = 'Ocorreu um erro ao cadastrar os itens do Pedido! Atualize a pagina e tente novamente';
                            $dados ['tela'] = 'pedidos/view_cadastropedido';
                        }
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao cadastrar o Pedido! Atualize a pagina e tente novamente';
                        $dados ['tela'] = 'pedidos/view_cadastropedido';
                    }
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'pedidos/view_cadastropedido';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['tela'] = 'pedidos/view_cadastropedido';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function alterarpedido() {
        if ($this->session->userdata('logged_in')) {
            $session_data = $this->session->userdata('logged_in');
            $usuarioid = $session_data['UsuarioId'];
            $this->load->model('model_pedido');

            if (($this->input->post('pedidoid')) && ($this->input->post('tabledata')) && (!empty(($this->input->post('tabledata'))))) {
                $dadospedido ['usuarioid'] = $usuarioid;
                $dadospedido ['clienteid'] = $this->input->post('clienteid');
                $pedidoid = $this->input->post('pedidoid');
                //$dadospedido ['codigopedido'] = $this->input->post('codigopedido');
                $dadospedido ['valorbruto'] = 0;
                $dadospedido ['valorliquido'] = 0;

                $this->load->model('model_pedido');

                $TodosItens = explode('||', $this->input->post('tabledata'));

                $CodeItens = explode(';', $TodosItens());
                $QtdeItens = explode(';', $TodosItens());
                $DescItens = explode(';', $TodosItens());

                $quantidade = 0;
                $valormercadoria = 0;
                $valorvenda = 0;

                $codigoproduto = '';
                $quantidadeproduto = '';
                $descontoproduto = '';

                $this->load->model('model_produto');
                $produtos = $this->model_produto->carregaprodutos();

                $resultadocadastroitem = '';

                $this->model_pedido->excluiritenspedido($pedidoid);
                $i = 1;
                foreach ($QtdeItens as $itens) {
                    $array = explode(':', $itens);
                    if ((!empty($array[1])) && ((int) $array[1] > 0)) {
                        $quantidadeproduto = $array[1];

                        $peganumqtde = str_replace('QTDE', '', $array[1]);

                        foreach ($DescItens as $desc) {
                            $array2 = explode(':', $desc);
                            if ($array2[0] === 'DESC' . $i) {
                                $descontoproduto = $array2[1];
                            }
                        }
                        foreach ($CodeItens as $code) {
                            $array3 = explode(':', $code);
                            if ($array3[0] === 'CODE' . $i) {
                                $codigoproduto = $array3[1];
                            }
                        }

                        foreach ($produtos as $prod) {
                            if ($prod->id === $codigoproduto) {
                                $quantidade = (int) $quantidade + (int) $quantidadeproduto;
                                $valorvenda = $prod->valorvenda;
                                $valormercadoria = (numer_format($prod->valorvenda, 2, '.', ',') * (int) $quantidadeproduto);
                                $valormercadoria = numer_format($valormercadoria, 2, '.', ',') - ((numer_format($valormercadoria, 2, '.', ',') * numer_format($descontoproduto, 2, '.', ',')) / 100);
                            }
                        }
                        $dadositens ['pedidoid'] = $pedidoid;
                        $dadositens ['clienteid'] = $this->input->post('clienteid');
                        $dadositens ['usuarioid'] = $usuarioid;
                        $dadositens ['produtoid'] = $codigoproduto;
                        $dadositens ['quantidade'] = $quantidadeproduto;
                        $dadositens ['valormercadoria'] = $valormercadoria;
                        $dadositens ['valorvenda'] = $valorvenda;
                        $dadositens ['desconto'] = $descontoproduto;

                        $resultadocadastroitem = $this->model_pedido->cadastraitens($dadositens);
                    }
                }

                if (!empty($resultadocadastroitem)) {
                    $dadospedido1 ['pedidoid'] = $dadositens ['pedidoid'];
                    $dadospedido1 ['valorbruto'] = $valormercadoria;
                    $dadospedido1 ['valorliquido'] = $valorvenda;
                    $this->load->model('model_pedido');
                    $resultadoatualizapedido = $this->model_pedido->atualizapedido($dadospedido1);

                    if ($resultadoatualizapedido) {
                        redirect('home/alterarpedido', 'refresh');
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao atualizar o Pedido! Atualize a pagina e tente novamente';
                        $dados ['tela'] = 'pedidos/view_cadastropedido';
                    }
                } else {
                    $dados ['msg'] = 'Ocorreu um erro ao cadastrar os itens do Pedido! Atualize a pagina e tente novamente';
                    $dados ['tela'] = 'pedidos/view_cadastropedido';
                }

                $this->load->view('view_home', $dados);
            } else if ($this->input->post('pedidoid')) {
                $this->load->model('model_cliente');
                $dados['resultadoClientes'] = $this->model_cliente->carregaclientespedido();
                $this->load->model('model_produto');
                $dados['produtos'] = $this->model_produto->carregaprodutos();
                $dados['pedido'] = $this->model_pedido->carregapedidoalteracao($this->input->post('pedidoid'));
                $dados['pedidoitens'] = $this->model_pedido->carregapedidoitensalteracao($this->input->post('pedidoid'));
                $dados ['tela'] = 'pedidos/view_alterapedido';
                $this->load->view('view_home', $dados);
            } else {
                $dados['pedidos'] = $this->model_pedido->carregapedidosnaoatendido();
                $dados ['tela'] = 'pedidos/view_formalterarpedido';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function consultarpedido() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                if ((($this->input->post('codigopedido')) && (!empty($this->input->post('codigopedido')))) ||
                        (($this->input->post('nome')) && (!empty($this->input->post('nome'))))) {
                    $dadospedido['codigopedido'] = $this->input->post('codigopedido');
                    $dadospedido['nome'] = $this->input->post('nome');

                    $this->load->model('model_pedido');
                    $resultado = $this->model_pedido->consultapedido($dadospedido);

                    $dados['pedidos'] = $resultado;
                    $dados ['tela'] = 'pedidos/view_formalterarpedido';
                    $this->load->view('view_home', $dados);
                } else {
                    $dados['tela'] = 'pedidos/view_formconsultapedido';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados['tela'] = 'pedidos/view_formconsultapedido';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function emissaopedido() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            $this->load->model('model_pedido');
            $resultadoPedidos = $this->model_pedido->carregapedidosnaoatendido();
            if ($this->input->post()) {
                if (($this->input->post('pedidoid')) && (!empty($this->input->post('pedidoid')))) {
                    $pedido = $this->input->post('pedidoid');
                    $res = $this->model_pedido->atendepedido($pedido);

                    if ($res) {
                        $dadosimpressao['pedidoid'] = $pedido;
                        $detpedidos = $this->model_pedido->consultapedido($dadosimpressao);

                        if (!empty($detpedidos)) {


                            $this->load->library('fpdf_gen');
                            $pdf = new FPDF("P", "mm", "A4");
                            $nomearquivo = date('YmdHis');
                            $extensao = '.pdf';
                            $dominio = $_SERVER['DOCUMENT_ROOT'];
                            $pegasite = $_SERVER['REQUEST_URI'];
                            $tratadominio = explode('/', $pegasite);
                            $site = $tratadominio[1];
                            $localarquivo = $dominio . '/' . $site . '/public/pdf/';

                            $infopedido = 'Pedido de Venda n: ' . $nomearquivo;

                            $pdf->SetAuthor(iconv('UTF-8', 'windows-1252', $infopedido), 0);
                            $pdf->SetTitle($nomearquivo, 0);
                            $pdf->AliasNbPages('{np}');
                            $pdf->SetAutoPageBreak(false);
                            $pdf->SetMargins(8, 8, 8, 8);
                            $pdf->AddPage();

                            $PageNo = 1;

                            $pdf->SetFont('Arial', '', 10);
                            $pdf->Rect(8, 8, 194, 8);

                            $pdf->Cell(194, 8, 'Pedido de Venda', 0, 0, "C");
                            $pdf->SetFontSize(8);
                            $pdf->Ln();

                            $pdf->SetX(10);
                            $pdf->SetY(10);
                            $pdf->Cell(194, 0, date('d/m/Y'), 0, 0, "R");

                            $pdf->SetX(24);
                            $pdf->SetY(14);
                            $pdf->Cell(192, 0, date('H:i:s'), 0, 0, "R");

                            $pdf->SetFontSize(9);
                            $pdf->Ln();

                            $codigopedido = 0;
                            $totalliquido = 0;
                            $totalbruto = 0;

                            foreach ($detpedidos as $detped) {
                                $codigopedido = $detped->codigopedido;
                                $totalliquido = $detped->valorliquido;
                                $totalbruto = $detped->valorbruto;

                                $pdf->Rect(8, 16, 97, 8);
                                $pdf->SetX(28);
                                $pdf->SetY(21);
                                $pdf->Cell(150, 0, 'Cliente : ' . $detped->nomefantasia, 0, 0, "L");

                                $pdf->Rect(105, 16, 97, 8);
                                $pdf->SetX(105);
                                if (!empty($detped->cnpj)) {
                                    $pdf->Cell(0, 0, 'CNPJ : ' . $detped->cnpj, 0, 0, "L");
                                } else {
                                    $pdf->Cell(0, 0, 'CPF : ' . $detped->cpf, 0, 0, "L");
                                }

                                $pdf->Rect(8, 24, 40, 8);
                                $pdf->SetX(28);
                                $pdf->SetY(29);
                                if (!empty($detped->celular)) {
                                    $pdf->Cell(150, 0, 'Celular : ' . $detped->celular, 0, 0, "L");
                                } else {
                                    $pdf->Cell(150, 0, 'Telefone : ' . $detped->telefone, 0, 0, "L");
                                }


                                $pdf->Rect(48, 24, 80, 8);
                                $pdf->SetX(48);
                                $pdf->Cell(0, 0, 'E-mail : ' . $detped->email, 0, 0, "L");

                                $pdf->Rect(128, 24, 74, 8);
                                $pdf->SetX(128);
                                $pdf->Cell(0, 0, 'Endereco : ' . $detped->endereco, 0, 0, "L");

                                $pdf->Rect(8, 32, 40, 8);
                                $pdf->SetX(28);
                                $pdf->SetY(37);
                                $pdf->Cell(0, 0, 'Bairro : ' . $detped->bairro, 0, 0, "L");

                                $pdf->Rect(48, 32, 120, 8);
                                $pdf->SetX(48);
                                $pdf->Cell(0, 0, 'Cidade/UF : ' . $detped->cidade . '/' . $detped->estado, 0, 0, "L");

                                $pdf->Rect(168, 32, 34, 8);
                                $pdf->SetX(168);
                                $pdf->Cell(0, 0, 'CEP : ' . $detped->cep, 0, 0, "L");
                            }
                            $pdf->Ln();
                            $pdf->SetY(28);
                            $pdf->Ln();

                            $pdf->Rect(8, 48, 194, 238);
                            $pdf->SetY(284);
                            $pdf->Cell(194, 8, 'Pagina' . $PageNo, 0, 0, "R");

                            $nomearquivo = $codigopedido . $extensao;
                            echo $pdf->Output('F', $localarquivo . iconv('UTF-8', 'windows-1252', $nomearquivo), 0);

                            $this->session->set_flashdata('msg', 'Pedido n <b>' . $codigopedido . ' </b> emitido com sucesso!');
                            redirect('home/emissaopedido', 'refresh');
                        } else {
                            $dados['msg'] = 'Ocorreu um erro ao obter as informações do pedido!';
                            $dados['pedidos'] = $resultadoPedidos;
                            $dados ['tela'] = 'pedidos/view_listapedidos';
                            $this->load->view('view_home', $dados);
                        }
                    } else {
                        $dados['msg'] = 'Ocorreu um erro ao emetir o pedido!';
                        $dados['pedidos'] = $resultadoPedidos;
                        $dados ['tela'] = 'pedidos/view_listapedidos';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados['msg'] = 'Os dados informados estão incorretos!';
                    $dados['pedidos'] = $resultadoPedidos;
                    $dados ['tela'] = 'pedidos/view_listapedidos';
                    $this->load->view('view_home', $dados);
                }
            } else {

                $dados['pedidos'] = $resultadoPedidos;
                $dados ['tela'] = 'pedidos/view_listapedidos';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function faturamentopedido() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            $this->load->model('model_pedido');
            $resultadoPedidos = $this->model_pedido->carregapedidosnaoemitido();
            if ($this->input->post()) {
                if (($this->input->post('pedidoid')) && (!empty($this->input->post('pedidoid')))) {
                    $pedido = $this->input->post('pedidoid');
                    $res = $this->model_pedido->atendepedido($pedido);

                    if ($res) {
                        $dadosimpressao['pedidoid'] = $pedido;
                        $detpedidos = $this->model_pedido->consultapedido($dadosimpressao);
                        if (!empty($detpedidos)) {
                            $this->load->library('fpdf_gen');
                            $pdf = new FPDF("P", "mm", "A4");
                            $nomearquivo = date('YmdHis') . '.pdf';
                            $dominio = $_SERVER['DOCUMENT_ROOT'];
                            $pegasite = $_SERVER['REQUEST_URI'];
                            $tratadominio = explode('/', $pegasite);
                            $site = $tratadominio[1];
                            $localarquivo = $dominio . '/' . $site . '/public/pdf/';

                            echo $pdf->Output($localarquivo . iconv('UTF-8', 'windows-1252', $nomearquivo), 'F');

                            $dados['msg'] = 'Pedido nº <a href="' . base_url('public/pdf/' . $nomearquivo) . '" target = "_blank">' . $pedido . ' </a> emitido com sucesso!';
                            $dados['pedidos'] = $resultadoPedidos;
                            $dados ['tela'] = 'pedidos/view_listapedidos';
                            $this->load->view('view_home', $dados);
                        } else {
                            $dados['msg'] = 'Ocorreu um erro ao obter as informações do pedido!';
                            $dados['pedidos'] = $resultadoPedidos;
                            $dados ['tela'] = 'pedidos/view_listapedidos';
                            $this->load->view('view_home', $dados);
                        }
                    } else {
                        $dados['msg'] = 'Ocorreu um erro ao emetir o pedido!';
                        $dados['pedidos'] = $resultadoPedidos;
                        $dados ['tela'] = 'pedidos/view_listapedidos';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados['msg'] = 'Os dados informados estão incorretos!';
                    $dados['pedidos'] = $resultadoPedidos;
                    $dados ['tela'] = 'pedidos/view_listapedidos';
                    $this->load->view('view_home', $dados);
                }
            } else {

                $dados['pedidos'] = $resultadoPedidos;
                $dados ['tela'] = 'pedidos/view_listapedidosemitidos';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function pedidosfaturados() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            $this->load->model('model_pedido');
            $resultadoPedidos = $this->model_pedido->carregapedidosfaturados();
            if ($this->input->post()) {
                if (($this->input->post('pedidoid')) && (!empty($this->input->post('pedidoid')))) {
                    $pedido = $this->input->post('pedidoid');
                    $res = $this->model_pedido->atendepedido($pedido);

                    if ($res) {
                        $dadosimpressao['pedidoid'] = $pedido;
                        $detpedidos = $this->model_pedido->consultapedido($dadosimpressao);
                        if (!empty($detpedidos)) {
                            $this->load->library('fpdf_gen');
                            $pdf = new FPDF("P", "mm", "A4");
                            $nomearquivo = date('YmdHis') . '.pdf';
                            $dominio = $_SERVER['DOCUMENT_ROOT'];
                            $pegasite = $_SERVER['REQUEST_URI'];
                            $tratadominio = explode('/', $pegasite);
                            $site = $tratadominio[1];
                            $localarquivo = $dominio . '/' . $site . '/public/pdf/';

                            echo $pdf->Output($localarquivo . iconv('UTF-8', 'windows-1252', $nomearquivo), 'F');

                            $dados['msg'] = 'Pedido nº <a href="' . base_url('public/pdf/' . $nomearquivo) . '" target = "_blank">' . $pedido . ' </a> emitido com sucesso!';
                            $dados['pedidos'] = $resultadoPedidos;
                            $dados ['tela'] = 'pedidos/view_listapedidosfaturados';
                            $this->load->view('view_home', $dados);
                        } else {
                            $dados['msg'] = 'Ocorreu um erro ao obter as informações do pedido!';
                            $dados['pedidos'] = $resultadoPedidos;
                            $dados ['tela'] = 'pedidos/view_listapedidos';
                            $this->load->view('view_home', $dados);
                        }
                    } else {
                        $dados['msg'] = 'Ocorreu um erro ao emetir o pedido!';
                        $dados['pedidos'] = $resultadoPedidos;
                        $dados ['tela'] = 'pedidos/view_listapedidos';
                        $this->load->view('view_home', $dados);
                    }
                } else {
                    $dados['msg'] = 'Os dados informados estão incorretos!';
                    $dados['pedidos'] = $resultadoPedidos;
                    $dados ['tela'] = 'pedidos/view_listapedidos';
                    $this->load->view('view_home', $dados);
                }
            } else {

                $dados['pedidos'] = $resultadoPedidos;
                $dados ['tela'] = 'pedidos/view_listapedidosfaturados';
                $this->load->view('view_home', $dados);
            }
        }
    }

    //
    //              Relatorios               //
    //
    function relatorioclientes() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                if (
                        (!empty(trim($this->input->post('descricaoproduto')))) &&
                        (!empty(trim($this->input->post('unidade')))) &&
                        (!empty(trim($this->input->post('valormercadoria')))) &&
                        (!empty(trim($this->input->post('valorvenda')))) &&
                        (!empty(trim($this->input->post('qtdeestoque')))) &&
                        (!empty(trim($this->input->post('descontopermitido')))) &&
                        (!empty(trim($this->input->post('alertaestoque')))) &&
                        (!empty(trim($this->input->post('qtdevendaminima')))) &&
                        (!empty(trim($this->input->post('qtdevalorminimo'))))
                ) {
                    $dadoscliente ['descricaoproduto'] = $this->input->post('descricaoproduto');
                    $dadoscliente ['unidade'] = $this->input->post('unidade');
                    $dadoscliente ['valormercadoria'] = $this->input->post('valormercadoria');
                    $dadoscliente ['valorvenda'] = $this->input->post('valorvenda');
                    $dadoscliente ['qtdeestoque'] = $this->input->post('qtdeestoque');
                    $dadoscliente ['descontopermitido'] = $this->input->post('descontopermitido');
                    $dadoscliente ['alertaestoque'] = $this->input->post('alertaestoque');
                    $dadoscliente ['qtdevendaminima'] = $this->input->post('qtdevendaminima');
                    $dadoscliente ['qtdevalorminimo'] = $this->input->post('qtdevalorminimo');

                    $this->load->model('model_produto');
                    $resultadocadastroproduto = $this->model_produto->cadastraproduto($dadoscliente);

                    if ($resultadocadastroproduto) {
                        $dados ['msg'] = 'Produto cadastrado com sucesso!!!';
                        $dados ['tela'] = 'produtos/view_listaproduto';
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao cadastrar o Produto! Atualize a p�gina e tente novamente';
                        $dados ['tela'] = 'produtos/view_cadastroproduto';
                    }
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'produtos/view_cadastroproduto';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['tela'] = 'produtos/view_cadastroproduto';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function relatoriopedidos() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                
            } else {
                $dados ['tela'] = 'produtos/view_formconsultaproduto';
                $this->load->view('view_home', $dados);
            }
        }
    }

    function relatorioprodutos() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                
            } else {
                $dados ['tela'] = 'produtos/view_listaproduto';
                $this->load->view('view_home', $dados);
            }
        }
    }

    //
    //          Agenda                  //
    //
    function agenda() {
        if ($this->session->userdata('logged_in')) {
            $this->load->model('model_perfil');
            $resultadoPerfil = $this->model_perfil->buscaPerfil();
            $dados ['resultadoPerfil'] = $resultadoPerfil;

            if ($this->input->post()) {
                if (
                        (!empty(trim($this->input->post('descricaoproduto')))) &&
                        (!empty(trim($this->input->post('unidade')))) &&
                        (!empty(trim($this->input->post('valormercadoria')))) &&
                        (!empty(trim($this->input->post('valorvenda')))) &&
                        (!empty(trim($this->input->post('qtdeestoque')))) &&
                        (!empty(trim($this->input->post('descontopermitido')))) &&
                        (!empty(trim($this->input->post('alertaestoque')))) &&
                        (!empty(trim($this->input->post('qtdevendaminima')))) &&
                        (!empty(trim($this->input->post('qtdevalorminimo'))))
                ) {
                    $dadoscliente ['descricaoproduto'] = $this->input->post('descricaoproduto');
                    $dadoscliente ['unidade'] = $this->input->post('unidade');
                    $dadoscliente ['valormercadoria'] = $this->input->post('valormercadoria');
                    $dadoscliente ['valorvenda'] = $this->input->post('valorvenda');
                    $dadoscliente ['qtdeestoque'] = $this->input->post('qtdeestoque');
                    $dadoscliente ['descontopermitido'] = $this->input->post('descontopermitido');
                    $dadoscliente ['alertaestoque'] = $this->input->post('alertaestoque');
                    $dadoscliente ['qtdevendaminima'] = $this->input->post('qtdevendaminima');
                    $dadoscliente ['qtdevalorminimo'] = $this->input->post('qtdevalorminimo');

                    $this->load->model('model_produto');
                    $resultadocadastroproduto = $this->model_produto->cadastraproduto($dadoscliente);

                    if ($resultadocadastroproduto) {
                        $dados ['msg'] = 'Produto cadastrado com sucesso!!!';
                        $dados ['tela'] = 'view_agenda';
                    } else {
                        $dados ['msg'] = 'Ocorreu um erro ao cadastrar o Produto! Atualize a p�gina e tente novamente';
                        $dados ['tela'] = 'view_agenda';
                    }
                    $this->load->view('view_home', $dados);
                } else {
                    $dados ['msg'] = 'Dados Imcompletos! Preencha os dados e tente novamente';
                    $dados ['tela'] = 'view_agenda';
                    $this->load->view('view_home', $dados);
                }
            } else {
                $dados ['tela'] = 'view_agenda';
                $this->load->view('view_home', $dados);
            }
        } else {
            $dados ['tela'] = 'view_agenda';
            $this->load->view('view_home', $dados);
        }
    }

    //
    //          Codigo de Barras                //
    //
    function geracodigobarras() {
        if ($this->input->post('codigoean')) {
            $codigoean = $this->input->post('codigoean');
            echo base_url('Barcode/barcode_generator') . '/code25/40/' . $codigoean . '/TRUE';
        } else {
            echo '';
        }
    }

}
