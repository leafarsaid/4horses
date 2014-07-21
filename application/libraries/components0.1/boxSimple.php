<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Component.php');

class boxSimple extends Component {
	
	public function __construct($label=null){
		$this->label = $label;
	}
	
	public function toString(){
		
		/**
		 HTML do componente
		 */
		$html1 = <<<CMP1
<div class="bloco_titulo">$this->label</div>
<div class="bloco_conteudo" style="float:left">
CMP1;
    
    	$html2 = <<<CMP2
</div> 
<div class="clear"></div>
CMP2;
		
		$return = $html1;
		
		foreach($this->childs AS $item){
			$return .= $item->toString();
		}
		
		$return .= $html2;
		
		return $return;
	}
}