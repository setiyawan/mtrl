<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Transaksi extends My_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */


    public function __construct() {
        parent::__construct();

    	$this->must_login();
    }
    
    // GET ACTION
    public function index() {
    	$get = $this->input->get();

    	$filter = array(
    		'status' => 1,
    		'transaction_date' => $this->Ternary->isempty_value($get['date'], date('Y-m-d')),
    	);

    	$data = array(
    		'active_page' => 'transaction',
    		'page_title' => 'Transaksi',
			'parent_page' => 'Home',
			'page_child' => 'Data Transaksi',
			'parent_page_url' => base_url(),
			'filter' => $filter,
    		'transaction' => $this->TransactionModel->get_transaction_dashboard($filter)
    	);
    	
		$this->load->view('transaction', $data);
	}

	public function detail() {
		$filter['transaction_id'] = $this->input->get('id', TRUE);
		if (empty($filter['transaction_id'])) {
			redirect(base_url().'transaction');
		}
		$filter['status'] = 1;

		$data_transaction = $this->TransactionModel->get_transaction($filter)[0];
		$data = array(
			'add_js' => 'custom.transaction',
			'active_page' => 'transaction', 
			'form_action' => 'update',
			'page_title' => 'Transaksi Detail',
			'parent_page' => 'Transaksi',
			'page_child' => 'Detail',
			'parent_page_url' => base_url() . 'transaksi',
			'transaction' => $data_transaction,
			'vehicle' => $this->VehicleModel->get_vehicle($filter),
			'material' => $this->MaterialModel->get_material($filter)
		);

		$this->load->view('transaction_form', $data);
	}

	public function tambah() {
		$filter['status'] = 1;

		$data = array(
			'add_js' => 'custom.transaction',
			'active_page' => 'transaction', 
			'form_action' => 'add',
			'page_title' => 'Tambah Transaksi Baru',
			'parent_page' => 'Transaksi',
			'page_child' => 'Tambah Data',
			'parent_page_url' => base_url() . 'transaksi',
			'vehicle' => $this->VehicleModel->get_vehicle($filter),
			'material' => $this->MaterialModel->get_material($filter)
		);

		$this->load->view('transaction_form', $data);
	}

	public function invoice() {
		$filter['transaction_id'] = $this->input->get('id', TRUE);
		if (empty($filter['transaction_id'])) {
			redirect(base_url().'transaction');
		}

		$data = array(
			'user_full_name' => $this->get_session_by_id('full_name'),
			'transaction' => $this->TransactionModel->get_transaction_invoice($filter)[0]
		);

		$this->load->view('invoice', $data);
	}

	// POST ACTION
	public function add() {
		$this->validate_referer();

		$post = $this->input->post();
		$data = array(
			'invoice_code' => $this->generate_invoice_code(),
			'transaction_time' => $post['transaction_time'],
			'vehicle_id' => $post['vehicle_id'],
			'receiver_name' => $post['receiver_name'],
			'license_plate' => $post['license_plate'],
			'driver_name' => $post['driver_name'],
			'material_id' => $post['material_id'],
			'volume' => $post['volume'],
			'item_price' => $post['item_price'],
			'total_price' => $post['total_price'],
			'is_paid_off' => $post['is_paid_off'] == "on" ? 1 : 0,
			'create_by' => $this->get_userid()
		);

		$result = $this->TransactionModel->add_transaction($data);
		$transaction_id = $this->db->insert_id();
		if ($result) {
			$this->set_alert('success', 'Data Transaksi berhasil ditambah');
		}

		redirect(base_url().'transaksi/detail?id='.$transaction_id);
	}

	public function update() {
		$this->validate_referer();
		
		$post = $this->input->post();
		$transaction_id = $post['transaction_id'];
		$is_paid_off = $post['is_paid_off'] == "on" ? 1 : 0;
		
		$data = array(
			'vehicle_id' => $post['vehicle_id'],
			'receiver_name' => $post['receiver_name'],
			'license_plate' => $post['license_plate'],
			'driver_name' => $post['driver_name'],
			'material_id' => $post['material_id'],
			'volume' => $post['volume'],
			'item_price' => $post['item_price'],
			'total_price' => $post['total_price'],
			'is_paid_off' => $is_paid_off,
			'update_by' => $this->get_userid(),
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		if ($is_paid_off == 1) {
			$filter = array (
				'transaction_id' => $transaction_id,
				'status' => 1
			);

			$prev_transaction = $this->TransactionModel->get_transaction($filter)[0];
			if ($prev_transaction['is_paid_off'] == 0 ) {
				$data['transaction_time'] = $this->TimeConstant->get_current_timestamp();
			}
		}

		$result = $this->TransactionModel->update_transaction($data, $transaction_id);
		if ($result) {
			$this->set_alert('success', 'Data Transaksi berhasil ditambah');
		}

		redirect(base_url().'transaksi/detail?id='.$transaction_id);
	}

	function generate_invoice_code() {
		$latest_id  = ($this->TransactionModel->get_latest_transaction_id() + 1);
		return 'INV-' .  str_pad($latest_id, 5, "0", STR_PAD_LEFT);
	}
}