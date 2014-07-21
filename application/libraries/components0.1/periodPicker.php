<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once('Component.php');

class periodPicker extends Component {
	
	public function __construct($label=null, $id=null, $init=null){
		$this->label = $label;
		$this->id = $id;
		$this->init = $init;
	}
	
	public function toString(){
		
		/**
		 HTML do componente
		 */
		$label = utf8_decode($this->label);
		
		$html = <<<CMP
<div class="campo data periodo">
	<div class="inicial">
		<label for="data_1">$label</label>
		<input id="data_1" name="data_1" maxlength="10" value="" class="campo hasDatepicker" type="text"><img title="Calendário" alt="Calendário" src="https://desenvolvimento.sascar.com.br/sistemaWeb/images/calendar_cal.gif" class="ui-datepicker-trigger">
	</div>
	<div class="campo label-periodo">a</div>
	<div class="final">
		<label for="data_2">&nbsp;</label>
		<input id="data_2" name="data_2" maxlength="10" value="" class="campo hasDatepicker" type="text"><img title="Calendário" alt="Calendário" src="https://desenvolvimento.sascar.com.br/sistemaWeb/images/calendar_cal.gif" class="ui-datepicker-trigger">
	</div>
</div>
CMP;
		
		return $html;
	}
}