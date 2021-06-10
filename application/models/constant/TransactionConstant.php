<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TransactionConstant extends CI_Model {
	function get_paidoff_status() {
		return array(
			'' => 'Semua',
			'1' => 'Lunas',
			'0' => 'Belum Lunas'
		);
	}
}

?>