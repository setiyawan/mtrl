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
    	$filter['status'] = 1;
    	$data = array(
    		'active_page' => 'expense',
    		'page_title' => 'Pengeluaran',
			'parent_page' => 'Home',
			'page_child' => 'Data Pengeluaran',
			'parent_page_url' => base_url(),
    		'expense' => $this->ExpenseModel->get_expense($filter)
    	);
		$this->load->view('expense', $data);
	}

	public function detail() {
		$filter['expense_id'] = $this->input->get('id', TRUE);
		if (empty($filter['expense_id'])) {
			redirect(base_url().'pengeluaran');
		}

		$expense_detail = $this->ExpenseModel->get_expense($filter)[0];
		$data = array(
			'active_page' => 'expense', 
			'form_action' => 'update',
			'page_title' => 'Pengeluaran Detail',
			'parent_page' => 'Pengeluaran',
			'page_child' => 'Detail',
			'parent_page_url' => base_url() . 'pengeluaran',
			'expense' => $expense_detail
		);

		if ($expense_detail['status'] != 1) {
			redirect(base_url().'pengeluaran');
		}

		$this->load->view('expense_form', $data);
	}

	public function tambah() {
		$data = array(
			'active_page' => 'expense', 
			'form_action' => 'add',
			'page_title' => 'Tambah Pengeluaran Baru',
			'parent_page' => 'Pengeluaran',
			'page_child' => 'Tambah Data',
			'parent_page_url' => base_url() . 'pengeluaran'
		);

		$this->load->view('expense_form', $data);
	}

	// POST ACTION
	public function add() {
		$this->validate_referer();

		$post = $this->input->post();
		$data = array(
			'expense_date' => $post['expense_date'],
			'amount' => $post['amount'],
			'description' => $post['description'],
			'status' => 1,
			'create_by' => 1
		);

		$result = $this->ExpenseModel->add_expense($data);
		$expense_id = $this->db->insert_id();

		redirect(base_url().'pengeluaran/detail?id='.$expense_id);
	}

	public function update() {
		$this->validate_referer();
		
		$post = $this->input->post();
		$expense_id = $post['expense_id'];
		$data = array(
			'expense_date' => $post['expense_date'],
			'amount' => $post['amount'],
			'description' => $post['description'],
			'update_by' => 2,
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$result = $this->ExpenseModel->update_expense($data, $expense_id);

		$this->set_alert('success', 'Data Pengeluaran berhasil diperbarui');

		redirect(base_url().'pengeluaran/detail?id='.$expense_id);
	}

	public function delete() {
		$this->validate_referer();
		
		$expense_id = $this->input->get('id', TRUE);
		$data = array(
			'status' => 3,
			'update_by' => 2,
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$result = $this->ExpenseModel->update_expense($data, $expense_id);

		redirect(base_url().'pengeluaran');
	}
}