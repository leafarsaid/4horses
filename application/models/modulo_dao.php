<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modulo_dao extends CI_Model {

    /**
     * Método construtor.
     * 
     * @return Void
     */
    public function __construct() {
        parent::__construct();
    }

    //public function 
    
    
    
    
    
    
    /**
     * Método que busca as informações do compartilhamento.
     * 
     * @param Mixed $condicoes
     * @param Mixed $limite
     *
     * @return Object
     */
    public function buscarInstancia() {
        $this->db->select('
            compartilhamento.cmpoid AS oid,
            compartilhamento.cmpvisibilidade AS visibilidade,
            compartilhamento.cmpobservacao AS observacao,
            compartilhamento.cmpanexo AS anexo,
            TO_CHAR(compartilhamento.cmpdt_cadastro, \'DD/MM/YYYY\') AS dt_cadastro,
            TO_CHAR(compartilhamento.cmpdt_cadastro, \'HH24:MI\') AS hr_cadastro,
            COUNT(DISTINCT comentario.cmnoid) AS comentarios,
            COUNT(DISTINCT compartilhamento_favorito.cmpfusuoid) AS favoritos,
            CASE
                WHEN
                    EXISTS (
                        SELECT
                            1
                        FROM
                            compartilhamento_favorito
                        WHERE
                            compartilhamento_favorito.cmpfcmpoid = compartilhamento.cmpoid
                        AND
                            compartilhamento_favorito.cmpfusuoid = '.$this->session->userdata('oid').'
                    )
                THEN
                    1
                ELSE
                    0
            END AS favorito,
            grupo.grpoid,
            grupo.grpnome AS grupo,
            grupo.grpidentificador AS identificador,
            ARRAY_TO_STRING(ARRAY_AGG(DISTINCT tag.tagnome), \',\') AS tags,
            ARRAY_TO_STRING(ARRAY_AGG(DISTINCT tag.tagidentificador), \',\') AS identificadores,
            url.urlendereco AS url,
            url.urlimagem AS imagem,
            url.urltitulo AS titulo,
            url.urldescricao AS descricao,
            usuarios.cd_usuario AS usuoid,
            usuarios.nm_usuario AS nome,
            usuarios.ds_login AS login,
            usuarios.usuavatar AS avatar,
            usuarios.usudepoid AS depoid,
            usuarios.usudepartamento AS departamento,
            usuarios.usudiroid AS diroid,
            usuarios.usudiretoria AS diretoria
        ', false);
        $this->db->from('compartilhamento');
        $this->db->join('comentario', 'compartilhamento.cmpoid = comentario.cmncmpoid', 'left');
        $this->db->join('compartilhamento_favorito', 'compartilhamento.cmpoid = compartilhamento_favorito.cmpfcmpoid', 'left');
        $this->db->join('compartilhamento_tag', 'compartilhamento.cmpoid = compartilhamento_tag.cmptcmpoid', 'left');
        $this->db->join('compartilhamento_tag AS compartilhamento_tag_real', 'compartilhamento.cmpoid = compartilhamento_tag_real.cmptcmpoid', 'left');
        $this->db->join('grupo', 'compartilhamento.cmpgrpoid = grupo.grpoid', 'left');
        $this->db->join('tag', 'compartilhamento_tag_real.cmpttagoid = tag.tagoid', 'left');
        $this->db->join('url', 'compartilhamento.cmpurloid = url.urloid', 'left');
        $this->db->join('usuarios', 'compartilhamento.cmpusuoid = usuarios.cd_usuario', 'inner');

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
        $this->db->order_by('compartilhamento.cmpoid DESC');

        $this->Principal_dao->setarLimite($limite);

        return $this->db->get();
    }

    /**
     * Método que conta os registros de compartilhamento.
     * 
     * @param Mixed $condicoes
     * @param String $juncao
     *
     * @return Integer
     */
    public function contarCompartilhamento($condicoes, $limite = false) {
        $this->db->select('
            COUNT(DISTINCT compartilhamento.cmpoid) AS compartilhamento
        ');
        $this->db->from('compartilhamento');
        $this->db->join('comentario', 'compartilhamento.cmpoid = comentario.cmncmpoid', 'left');
        $this->db->join('compartilhamento_favorito', 'compartilhamento.cmpoid = compartilhamento_favorito.cmpfcmpoid', 'left');
        $this->db->join('compartilhamento_tag', 'compartilhamento.cmpoid = compartilhamento_tag.cmptcmpoid', 'left');
        $this->db->join('compartilhamento_tag AS compartilhamento_tag_real', 'compartilhamento.cmpoid = compartilhamento_tag_real.cmptcmpoid', 'left');
        $this->db->join('tag', 'compartilhamento_tag_real.cmpttagoid = tag.tagoid', 'left');
        $this->db->join('url', 'compartilhamento.cmpurloid = url.urloid', 'left');
        $this->db->join('usuarios', 'compartilhamento.cmpusuoid = usuarios.cd_usuario', 'inner');

        if (is_string($condicoes)) {
            $this->db->where($condicoes, null, false);
        } elseif (is_array($condicoes) and count($condicoes)) {
            $this->db->where($condicoes);
        }

        $resultado = $this->db->get();

        if ($resultado === false) {
            return 0;
        }

        $resultado = $resultado->row_array();

        return $resultado['compartilhamento'];
    }

    /**
     * Método que exclui as informações do compartilhamento.
     * 
     * @param Mixed $condicoes
     *
     * @return Boolean
     */
    public function excluirCompartilhamento($condicoes) {
        if (is_string($condicoes)) {
            $this->db->where($condicoes, null, false);
        } elseif (is_array($condicoes) and count($condicoes)) {
            $this->db->where($condicoes);
        } else {
            return false;
        }

        $this->db->delete('compartilhamento');

        if ($this->db->affected_rows() !== 1) return false;

        return true;
    }

    /**
     * Método que salva as informações do compartilhamento.
     * 
     * @param Array $infos
     *
     * @return Mixed
     */
    public function salvarCompartilhamento($infos = array()) {
        if (!is_array($infos) or count($infos) == 0) return false;

        if (empty($infos['cmpoid'])) {
            $this->db->insert('compartilhamento', $infos);

            $infos['cmpoid'] = $this->db->insert_id();
        } else {
            $this->db->where('cmpoid', $infos['cmpoid']);
            $this->db->update('compartilhamento', $infos);
        }

        if ($this->db->affected_rows() !== 1) return false;

        return $infos['cmpoid'];
    }

}

/* End of file modulo_dao.php */
/* Location: ./application/models/modulo_dao.php */