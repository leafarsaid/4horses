<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comanda extends CI_Controller {

	/**
	 * Método construtor.
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	
		$this->load->model('Comanda_dao');		
		
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{		
		$dados = array();
				
		$this->load->view('comanda',$dados);
		
	}

	public function teste(){
		echo 'teste';
	}
}

/* End of file comanda.php */
/* Location: ./application/controllers/comanda.php */