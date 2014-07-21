<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Component {
	
	public $label;
	
	public $id;
	
	public $init;
	
	public $style;
	
	public $mask;
	
	public $objValidate;
	
	public $dataset;
	
	public $childs = array();
	
	public $parent;
	
	public $script;
	
	protected $helpful;
	
	abstract protected function toString();
	
	public function setChild($child){				
		array_push($this->childs, $child);
		
	}
	
}