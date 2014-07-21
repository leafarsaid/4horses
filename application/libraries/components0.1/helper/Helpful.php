<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Helpful {
	
	public $conn;
	
	public function __construct($conn){
		$this->conn = $conn;
	}
	
	public function init($DOM){
		$json = '';
		if (isset($_POST['builderAjax'])){
			
			switch ($_POST['action']) {
				case 'loadParent':
										
					$query = $this->getAttrById($DOM, 'dataset', $_POST['attrib2']);
					
					$query = str_replace('!!parent!!', $_POST['attrib1'], $query);
					$json = $this->simpleQuery($query);
					
					if (strlen($json) > 5) {
						echo $json;
					} else{
						echo json_encode(array("0"=>"0"));
					}
					
					break;
				case 'loadQuery':
					
					$query = ($_POST['attrib1']);
					$json = $this->simpleQuery($query);
					
					if (strlen($json) > 5) {
						echo $json;
					} else{
						echo json_encode(array("0"=>"0"));
					}
										
					break;
				default:
					break;
			}
			
			exit();
		}
	}
	
	private function simpleQuery($query){
		
		try {
			$result = pg_query($this->conn,$query);
			
			if (!$result){
				throw new Exception("Erro na query: $query",1);
			}
			
			$arrAux = pg_fetch_all($result);
			
			//$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
			$json = '{';
			
			foreach ($arrAux AS $item){
				
				if (is_int($item['id'])){
					$key = $item['id'];
				} else{
					$key = '"'.utf8_encode($item['id']).'"';
				}
				
				$val = '"'.utf8_encode($item['desc']).'"';
				
				$json .= $key.':'.$val.',';
			}
			
			$json = substr($json,0,-1);
			$json .= '}';
			
			return $json;
		}
		catch (Exception $e){
			return json_encode(array(
					"error"	=>'t',
					"code"	=>$e->getCode(),
					"msg"	=>$e->getMessage()
					));
		}
	}	
	
	/**
	 * 
	 * Retorna um atributo de um elemento do DOM pelo seu id
	 *
	 * @author Rafael Dias <rafael.dias@sascar.com.br>
	 * @version 14/05/2014
	 * @param unknown_type $Obj (objeto inicial - geralmente o objeto DOM em caso de busca pela raiz)
	 * @param unknown_type $attr
	 * @param unknown_type $id
	 * @return string/array
	 */
	public function getAttrById($Obj, $attr, $id){
				
		if ($Obj->id == $id){
			return $Obj->$attr;
		}
				
		if (is_object($Obj->main)){
			$root = $Obj->main;
		} else if(is_array($Obj->childs)){
			$root = $Obj->childs;
		} else {
			return null;
		}
				
		foreach ($root AS $element){
			if ($element->id == $id){
				return $element->$attr;
			} else{
				return $this->getAttrById($element, $attr, $id);
			}
		}
		
		return null;
		
	}
	
	/**
	 * 
	 * Converte um xml em um Objeto DOM
	 *
	 * @author Rafael Dias <rafael.dias@sascar.com.br>
	 * @version 08/05/2014
	 * @param unknown_type $xml
	 * @return unknown
	 */
	public function convert($xml,$objReturn=null) {
		
		$nodeName = $xml->getName();	
		
		$componentes_aceitos = array('box','listBox','hiddenBox','inputText','optionBox','periodPicker');		
		
		if ($nodeName == 'dom') {
			$DOM = Dom::singleton();
			$DOM->main = $objInstance = new mainBox();			
			$this->setAttr($DOM, $xml);
		}		
		elseif ($nodeName == 'mainBox') {
			$objInstance = $objReturn;
		}		
		elseif ($nodeName == 'listBox') {
			$objInstance = new listBox('','','',$xml->attributes()->style);
			if ($xml->children()->count() > 0) {
				$objInstance->dataset = $this->setOptions($xml);
			} else{
				$objInstance->dataset = utf8_decode($xml);
			}
		}
		elseif ($nodeName == 'inputText') {
			$objInstance = new inputText('','','',$xml->attributes()->style);
		}
		elseif ($nodeName == 'option'){
			//do nothing
			$objInstance = $objReturn;
		}
		elseif ($nodeName == 'button' || $nodeName == 'radioButton' || $nodeName == 'checkBox'){
			//do nothing
			$objInstance = $objReturn;
		}
		else{
			$objInstance = new $nodeName();
		}
		
		$i = 0;		
		foreach($xml->children() as $child) {
				
			$childName = $child->getName();
						
			$objChild = $this->convert($child,$objInstance);	
			
			if (is_object($objChild)) {
				if (in_array($childName, $componentes_aceitos)){
					$objInstance->setChild($objChild);
				}
			}

			$this->setAttr($objChild, $child);
			
			$i++;
		}
		
		if (is_object($DOM)){
			return $DOM;
		} elseif (is_object($objInstance)){
			return $objInstance;
		} else{
			return false;
		}
	}
		
	/**
	 * 
	 * Converte os atributos do nó xml ao objeto php.
	 *
	 * @author Rafael Dias <rafael.dias@sascar.com.br>
	 * @version 13/05/2014
	 * @param unknown_type $obj
	 * @param unknown_type $node
	 */
	public function setAttr($obj, $node){
		foreach($node->attributes() as $attr){
			$attrName = $attr->getName();
			if ($attrName != 'style' && $attrName != 'dataset'){
				$obj->$attrName = $attr->__toString();				
			}
		}
	}
	
	/**
	 * 
	 * [Não está em uso no momento] Construtor de datasets para componentes
	 *
	 * @author Rafael Dias <rafael.dias@sascar.com.br>
	 * @version 13/05/2014
	 * @param unknown_type $node
	 * @return multitype:NULL
	 */
	public function setAttrToArray($node){
		$arr = array();
		
		foreach($node->attributes() as $attr){
			$arr[$attr->getName()] = $attr->__toString();
		}
		
		return $arr;
	}
	
	/**
	 * 
	 * Construtor dos componentes <option> de um <listbox>
	 *
	 * @author Rafael Dias <rafael.dias@sascar.com.br>
	 * @version 13/05/2014
	 * @param unknown_type $node
	 * @return multitype:unknown
	 */
	public function setOptions($node){
		$arr = array();
		
		foreach($node->children() as $opt){
			if ($opt->getName() == 'option'){
				$value = $opt->attributes()->value;
				if (is_object($value)){
					$arr[utf8_decode($value->__toString())] = utf8_decode($opt);
				}
			}
		}
		
		return $arr;
	}
	
	public function encriptQuery($query){		
		//$query = substr($query,1,-1);
		
		//Inicio
		
					
		$return = $query;
		
		//return '"'.$return.'"';
		return $return;
	}
	
	public function decriptQuery($query){
		
		//Inicio
		
		$return = $query;
		
		return $return;
	}
}
/* End of file Helpful.php */