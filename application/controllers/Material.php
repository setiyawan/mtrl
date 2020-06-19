<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Material extends My_Controller {

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
    		'active_page' => 'material',
    		'page_title' => 'Material',
			'parent_page' => 'Home',
			'page_child' => 'Data Material',
			'parent_page_url' => base_url(),
    		'material' => $this->MaterialModel->get_material($filter)
    	);
		$this->load->view('material', $data);
	}

	public function detail() {
		$filter['material_id'] = $this->input->get('id', TRUE);
		if (empty($filter['material_id'])) {
			redirect(base_url().'material');
		}

		$data = array(
			'active_page' => 'material', 
			'form_action' => 'update',
			'page_title' => 'Material Detail',
			'parent_page' => 'Material',
			'page_child' => 'Detail',
			'parent_page_url' => base_url() . 'material',
			'material' => $this->MaterialModel->get_material($filter)[0]
		);

		$this->load->view('material_form', $data);
	}

	public function tambah() {
		$data = array(
			'active_page' => 'material', 
			'form_action' => 'add',
			'page_title' => 'Tambah Material Baru',
			'parent_page' => 'Material',
			'page_child' => 'Tambah Data',
			'parent_page_url' => base_url() . 'material'
		);

		$this->load->view('material_form', $data);
	}

	// POST ACTION
	public function add() {
		$this->validate_referer();

		$post = $this->input->post();
		$data = array(
			'material_name' => $post['material_name'],
			'material_code' => $post['material_code'],
			'price' => $post['price'],
			'description' => $post['description'],
			'status' => 1,
			'create_by' => 1
		);

		$result = $this->MaterialModel->add_material($data);
		$material_id = $this->db->insert_id();
		if ($result) {
			$this->set_alert('success', 'Data Material berhasil ditambahkan');
		}

		redirect(base_url().'material/detail?id='.$material_id);
	}

	public function update() {
		$this->validate_referer();
		
		$post = $this->input->post();
		$material_id = $post['material_id'];
		$data = array(
			'material_name' => $post['material_name'],
			'material_code' => $post['material_code'],
			'price' => $post['price'],
			'description' => $post['description'],
			'update_by' => 2,
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$result = $this->MaterialModel->update_material($data, $material_id);
		if ($result) {
			$this->set_alert('success', 'Data Material berhasil diperbarui');
		}

		redirect(base_url().'material/detail?id='.$material_id);
	}

	public function delete() {
		$this->validate_referer();
		
		$material_id = $this->input->get('id', TRUE);
		$data = array(
			'status' => 3,
			'update_by' => 2,
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$result = $this->MaterialModel->update_material($data, $material_id);
		if ($result) {
			$this->set_alert('success', 'Data Material berhasil dihapus');
		}

		redirect(base_url().'material');
	}
}