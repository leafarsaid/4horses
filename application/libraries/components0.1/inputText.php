<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Component.php');

class inputText extends Component {
	
	public function __construct($label=null, $id=null, $init=null, $style=null){
		$this->label = $label;
		$this->id = $id;
		$this->init = $init;
		switch ($style){
			case 'i':
				$this->style = 'campo menor';
				break;
			case 'ii':
				$this->style = 'campo medio';
				break;
			case 'iii':
				$this->style = 'campo maior';
				break;
			default:
				$this->style = 'campo medio';
				break;
		}
	}
	
	public function toString(){
		
		/**
		 HTML do componente
		 */
		$html = <<<CMP
<div class="$this->style">
	<label for="$this->id">$this->label</label>
	<input type="text" class="campo" id="$this->id" name="$this->id" value="$this->init" />
</div>
CMP;
		
		return $html;
	}
}