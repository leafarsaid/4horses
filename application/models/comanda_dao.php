<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class omanda_dao extends CI_Model {

    /**
     * Método construtor.
     * 
     * @return Void
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Método que lista os PEdidos
     * 
     * @param Mixed $condicoes
     * @param Mixed $limite
     *
     * @return Object
     */
    public function listaPedido($condicoes) {
        $this->db->select('
            c01_codigo,
        	c02_codigo,
        	
        ', false);
        $this->db->from('t05_pedido_item');
        $this->db->join('t01_pedido', 't01_pedido.c01_codigo = t05_pedido_item.c01_codigo', 'inner');
        $this->db->join('t02_item', 't02_item.c02_codigo = t05_pedido_item.c02_codigo', 'inner');
        $this->db->join('t03_tipoitem', 't03_tipoitem.c03_codigo = t02_item.c03_codigo', 'inner');
        $this->db->join('t04_empresa', 't04_empresa.c04_codigo = t01_pedido.c04_codigo', 'inner');

        if (is_string($condicoes)) {
            $this->db->where($condicoes, null, false);
        } elseif (is_array($condicoes) and count($condicoes)) {
            $this->db->where($condicoes);
        }

        $this->db->group_by('
            compartilhamento.cmpoid,
            grupo.grpoid,
            url.urloid,
            usuarios.cd_usuario
        ');
        $this->db->order_by('t05_pedido_item.c01_codigo DESC');

        $this->Principal_dao->setarLimite($limite);

        return $this->db->get();
    }
}

/* End of file modulo_dao.php */
/* Location: ./application/models/modulo_dao.php */