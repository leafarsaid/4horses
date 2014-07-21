<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Component.php');

class box extends Component {
	
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
	<div class="formulario">
CMP1;
    
    	$html2 = <<<CMP2
    </div>	
</div> 
<div class="clear"></div>
<div class="bloco_acoes"><button type="button">Botão</button></div>
CMP2;
		
		$return = $html1;
		
		foreach($this->childs AS $item){
			$return .= $item->toString();
		}
		
		$return .= $html2;
		
		return $return;
	}
}