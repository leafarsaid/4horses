<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Component.php');

class optionBox extends Component {
	
	public function __construct($label=null){
		$this->label = $label;
	}
	
	public function toString(){
		
		/**
		 HTML do componente
		 */
		$label = utf8_decode($this->label);
		
		$html1 = <<<CMP1
<fieldset class="medio opcoes-inline">
	<legend>$label</legend>
CMP1;
    
    	$html2 = <<<CMP2
</fieldset>
CMP2;
		
		$return = $html1;
		
		foreach($this->childs AS $item){
			$return .= $item->toString();
		}
		
		$return .= $html2;
		
		return $return;
	}
}