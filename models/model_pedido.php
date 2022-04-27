<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Modelo model_usuario - Efetua a busca dos dados no banco
 *
 * @author Wagner
 */
class Model_pedido extends CI_Model {

    function cadastrapedido($dados = NULL) {
        if ($dados !== NULL) {
            $this->db->insert('pedido', $dados);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function cadastraitens($dados = NULL) {
        if ($dados !== NULL) {
            $this->db->insert('pedidoitens', $dados);
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function atualizapedido($dados = NULL) {
        if ($dados !== NULL) {
            $this->db->where('pedidoid', $dados['pedidoid']);
            $this->db->update('pedido', $dados);
            return true;
        } else {
            return false;
        }
    }

    function carregapedidosnaoatendido() {
        $this->db->select('*');
        $this->db->from('pedido ped');
        $this->db->join('cliente cli', 'cli.id = ped.clienteid');
        $this->db->join('usuarios usu', 'usu.id = ped.usuarioid');
        $this->db->where('ped.emitido', 0);
        $this->db->where('ped.atendido', 0);

        $query = $this->db->get();
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function carregapedidosnaoemitido() {
        $this->db->select('*');
        $this->db->from('pedido ped');
        $this->db->join('cliente cli', 'cli.id = ped.clienteid');
        $this->db->join('usuarios usu', 'usu.id = ped.usuarioid');
        $this->db->where('ped.emitido', 1);
        $this->db->where('ped.atendido', 0);

        $query = $this->db->get();
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function carregapedidoalteracao($pedidoid) {
        $this->db->select('*');
        $this->db->from('pedido ped');
        $this->db->join('cliente cli', 'cli.id = ped.clienteid');
        $this->db->join('usuarios usu', 'usu.id = ped.usuarioid');
        $this->db->where('ped.pedidoid', $pedidoid);

        $query = $this->db->get();
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function carregapedidoitensalteracao($pedidoid) {
        $this->db->select('*');
        $this->db->from('pedidoitens pi');
        $this->db->where('pi.pedidoid', $pedidoid);

        $query = $this->db->get();
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

    function excluiritenspedido($pedidoid) {
        $this->db->where("pedidoid", $pedidoid);
        $this->db->delete("pedidoitens");
    }

    function consultapedido($dados) {
        if ($dados != NULL) {
            extract($dados);
            $this->db->select('*');
            $this->db->from('pedido ped');
            $this->db->join('cliente cli', 'cli.id = ped.clienteid');
            $this->db->join('usuarios usu', 'usu.id = ped.usuarioid');

            if ((isset($dados['codigopedido'])) && (!empty($dados['codigopedido']))) {
                $this->db->where('ped.codigopedido', $dados['codigopedido']);
            }

            if ((isset($dados['nome'])) && (!empty($dados['nome']))) {
                $this->db->where("cli.nomefantasia like '%" . $dados['nome'] . "%'", NULL);
                $this->db->or_where("cli.razaosocial like '%" . $dados['nome'] . "%'", NULL);
            }

            if ((isset($dados['pedidoid'])) && (!empty($dados['pedidoid']))) {
                $this->db->where('ped.pedidoid', $dados['pedidoid']);
            }

            $query = $this->db->get();
            if ($query) {
                return $query->result();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function atendepedido($pedidoid) {
        $this->db->set('emitido', 1);
        $this->db->where('pedidoid', $pedidoid);
        $this->db->update('pedido');
        return true;
    }

    function carregapedidosfaturados() {
        $this->db->select('*');
        $this->db->from('pedido ped');
        $this->db->join('cliente cli', 'cli.id = ped.clienteid');
        $this->db->join('usuarios usu', 'usu.id = ped.usuarioid');
        $this->db->where('ped.emitido', 1);
        $this->db->where('ped.atendido', 1);

        $query = $this->db->get();
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }

}
