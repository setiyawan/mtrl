<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Pengeluaran extends My_Controller {

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
    		'cashflow_type' => 2,
    		'date' => $this->Ternary->isempty_value($get['date'], date('Y-m-d')),
    	);

    	$data = array(
    		'active_page' => 'expense',
    		'page_title' => 'Pengeluaran',
			'parent_page' => 'Home',
			'page_child' => 'Data Pengeluaran',
			'parent_page_url' => base_url(),
			'filter' => $filter,
			'cashflow_type' => 'pengeluaran',
    		'cashflow' => $this->CashflowModel->get_cashflow($filter)
    	);
		$this->load->view('cashflow', $data);
	}

	public function detail() {
		$id = $this->input->get('id', TRUE);
		if (empty($id)) {
			redirect(base_url().'pengeluaran');
		}

    	$filter = array(
    		'cashflow_id' => $id,
    		'status' => 1,
    		'cashflow_type' => 2,
    	);

		$cashflow_detail = $this->CashflowModel->get_cashflow($filter)[0];
		$data = array(
			'active_page' => 'expense', 
			'form_action' => 'update',
			'page_title' => 'Pengeluaran Detail',
			'parent_page' => 'Pengeluaran',
			'page_child' => 'Detail',
			'parent_page_url' => base_url() . 'pengeluaran',
			'cashflow_type' => 'pengeluaran',
			'cashflow' => $cashflow_detail
		);

		if ($cashflow_detail['status'] != 1) {
			redirect(base_url().'pengeluaran');
		}

		$this->load->view('cashflow_form', $data);
	}

	public function tambah() {
		$data = array(
			'active_page' => 'expense', 
			'form_action' => 'add',
			'page_title' => 'Tambah Pengeluaran Baru',
			'parent_page' => 'Pengeluaran',
			'page_child' => 'Tambah Data',
			'cashflow_type' => 'pengeluaran',
			'parent_page_url' => base_url() . 'pengeluaran'
		);

		$this->load->view('cashflow_form', $data);
	}

	// POST ACTION
	public function add() {
		$this->validate_referer();

		$post = $this->input->post();
		$data = array(
			'cashflow_date' => $post['cashflow_date'],
			'amount' => $post['amount'],
			'description' => $post['description'],
			'status' => 1,
			'cashflow_type' => 2,
			'create_by' => $this->get_userid()
		);

		$result = $this->CashflowModel->add_cashflow($data);
		$cashflow_id = $this->db->insert_id();

		redirect(base_url().'pengeluaran/detail?id='.$cashflow_id);
	}

	public function update() {
		$this->validate_referer();
		
		$post = $this->input->post();
		$cashflow_id = $post['cashflow_id'];
		$data = array(
			'cashflow_date' => $post['cashflow_date'],
			'amount' => $post['amount'],
			'description' => $post['description'],
			'update_by' => $this->get_userid(),
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$result = $this->CashflowModel->update_cashflow($data, $cashflow_id);

		$this->set_alert('success', 'Data Pengeluaran berhasil diperbarui');

		redirect(base_url().'pengeluaran/detail?id='.$cashflow_id);
	}

	public function delete() {
		$this->validate_referer();
		
		$cashflow_id = $this->input->get('id', TRUE);
		$data = array(
			'status' => 3,
			'update_by' => $this->get_userid(),
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$result = $this->CashflowModel->update_cashflow($data, $cashflow_id);

		redirect(base_url().'pengeluaran');
	}
}