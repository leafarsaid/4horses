<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Component.php');

class mainBox extends Component {
		
	public function __construct(){}
	
	public function toString(){
		
		/**
		 HTML do componente
		 */
		$label = $this->label;
		
		$html1 = <<<CMP1
<div class="modulo_titulo">$label</div>
<div class="modulo_conteudo" style="float:left">
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