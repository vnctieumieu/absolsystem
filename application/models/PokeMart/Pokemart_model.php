<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pokemart_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}
	public function GetProductType()
	{
		return $this->db->query("SELECT producttype.id, producttype.typeName FROM producttype WHERE producttype.status = 1")->result_array();
	}
}

/* End of file Pokemart_model.php */
/* Location: ./application/models/Pokemart_model.php */