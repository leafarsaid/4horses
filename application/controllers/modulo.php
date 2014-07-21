<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Modulo extends CI_Controller {

	/**
	 * Método construtor.
	 *
	 * @return Void
	 */
	public function __construct() {
		parent::__construct();
	
		$this->load->model('Modulo_dao');		
		
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
		
		$params = array('path' => './application/views/modulos/principal/proposta/fluxo.xml');
		$this->load->library('ci_easyxml',$params); # Loading the library with the xml file path.
		 
		echo $this->ci_easyxml->get_num_elements(); # Returning the number of elements.
		 
		// Verifying if the child "author" in the path "/catalog/book/author" exists or not.
		if( $childs = $this->ci_easyxml->child_exists('/catalog/book/author') )
		{
		echo "<br><br>The child exists.<br><pre>";
		print_r($childs);
		echo "</pre><hr>";
		}
		else
		{
		echo "<br>The child does not exists.";
		}
		 
		// Verifying if the value "id" in the path "/catalog/book" exists or not.
		if( $value = $this->ci_easyxml->attribute_value_exists('/catalog/book','id','bk103') )
		{
		 
		echo "<br><br>The value exists.<br><pre>";
		print_r($value);
		echo "</pre><hr>";
		}
		else
		{
		echo "<br>The value does not exists.";
		}
		 
		// Removing a node based on its attribute value.
		//$this->ci_easyxml->removeNodeByAttrib('book','id','bk113'); # Uncomment to delete the node.
		 
		// Inserting new book
		$bk['author'] = "Test Author";
		$bk['title'] = "Test Title";
		$bk['genre'] = "Test Genre";
		$bk['price'] = "0.00";
		$bk['publish_date'] = "00-00-0000";
		$bk['description'] = "Test Description";
		
		#$bk_last_id = $this->ci_easyxml->insert_book($bk); # Uncomment to insert a new book.
		#echo "<br>" . $bk_last_id . "<br>";
		 
		// UPDATING BOOK
		$bk['id'] = "bk114"; # BOOK ID
		$bk['author'] = "Test Author EDIT";
		$bk['title'] = "Test Title EDIT";
		$bk['genre'] = "Test Genre EDIT";
		$bk['price'] = "1.00";
		$bk['publish_date'] = "00-00-2013";
		$bk['description'] = "Test Description EDIT";
		
		#$bk_id = $this->ci_easyxml->update_book($bk); # Uncomment to update a book.
		#echo "<br>";
		#print_r($bk_id);
		#echo "<br>";
		
		
 
		
		$dados = array();
		
		$dataset = array(
				'1'	=>	'teste1',
				'2'	=>	'teste2',
				'3'	=>	'teste3',
				'4'	=>	'teste4',
				'5'	=>	'teste5'
				);
		
		$dados['combo1'] = $this->dom->listBox('Teste de combão','teste',3,'tipo1',$dataset);
		$dados['service'] = 'teste: '.$_REQUEST['service'];
		
		$this->load->view('modulo',$dados);
		
	}
}

/* End of file modulo.php */
/* Location: ./application/controllers/modulo.php */