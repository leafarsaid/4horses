<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Component.php');

class hiddenBox extends Component {
	
	public function __construct($label=null, $style=null){
		$this->label = $label;
		switch ($style){
			case 'i':
				$this->style = ' painelMenor';
				break;
			case 'ii':
				$this->style = ' painelMedio';
				break;
			default:
				$this->style = '';
				break;
		}
	}
	
	public function toString(){
		
		$none = ($this->label == '') ? ' style="display:none"' : '';
		
		/**
		 HTML do componente
		 */
		$html1 = <<<CMP1
<div class="blocoOculto$this->style" style="float:left">
	<div class="blocoOculto_titulo"$none>$this->label</div>
	<div class="blocoOculto_conteudo">
CMP1;
    
    	$html2 = <<<CMP2
	</div>
    <br />    
</div>
CMP2;
		
		$return = $html1;
		
		
		foreach($this->childs AS $item){
			$return .= $item->toString();
		}
		
		$return .= $html2;
		
		return $return;
	}
}