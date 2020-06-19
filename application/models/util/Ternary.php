<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Ternary extends CI_Model {
	function isset_value($option1='', $option2='') {
		return isset($option1) ? $option1 : $option2;
	}

	function isempty_value($option1='', $option2='') {
		return !empty($option1) ? $option1 : $option2;
	}
}