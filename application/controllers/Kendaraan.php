<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Kendaraan extends My_Controller {

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
    		'active_page' => 'vehicle',
    		'page_title' => 'Kendaraan',
			'parent_page' => 'Home',
			'page_child' => 'Data Kendaraan',
			'parent_page_url' => base_url(),
    		'vehicle' => $this->VehicleModel->get_vehicle($filter)
    	);
		$this->load->view('vehicle', $data);
	}

	public function detail() {
		$filter['vehicle_id'] = $this->input->get('id', TRUE);
		if (empty($filter['vehicle_id'])) {
			redirect(base_url().'vehicle');
		}

		$data = array(
			'active_page' => 'vehicle', 
			'form_action' => 'update',
			'page_title' => 'Kendaraan Detail',
			'parent_page' => 'Kendaraan',
			'page_child' => 'Detail',
			'parent_page_url' => base_url() . 'kendaraan',
			'vehicle' => $this->VehicleModel->get_vehicle($filter)[0]
		);

		$this->load->view('vehicle_form', $data);
	}

	public function tambah() {
		$data = array(
			'active_page' => 'vehicle', 
			'form_action' => 'add',
			'page_title' => 'Tambah Kendaraan Baru',
			'parent_page' => 'Kendaraan',
			'page_child' => 'Tambah Data',
			'parent_page_url' => base_url() . 'kendaraan'
		);

		$this->load->view('vehicle_form', $data);
	}

	// POST ACTION
	public function add() {
		$this->validate_referer();

		$post = $this->input->post();
		$data = array(
			'vehicle_type' => $post['vehicle_type'],
			'license_plate' => $post['license_plate'],
			'tax_period' => $post['tax_period'],
			'length' => $post['length'],
			'width' => $post['width'],
			'height' => $post['height'],
			'owner_name' => $post['owner_name'],
			'status' => 1,
			'create_by' => $this->get_userid()
		);

		$result = $this->VehicleModel->add_vehicle($data);
		$vehicle_id = $this->db->insert_id();
		if ($result) {
			$this->set_alert('success', 'Data Kendaraan berhasil ditambah');
		}

		redirect(base_url().'kendaraan/detail?id='.$vehicle_id);
	}

	public function update() {
		$this->validate_referer();
		
		$post = $this->input->post();
		$vehicle_id = $post['vehicle_id'];
		$data = array(
			'vehicle_type' => $post['vehicle_type'],
			'license_plate' => $post['license_plate'],
			'tax_period' => $post['tax_period'],
			'length' => $post['length'],
			'width' => $post['width'],
			'height' => $post['height'],
			'owner_name' => $post['owner_name'],
			'status' => 1,
			'update_by' => $this->get_userid(),
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$result = $this->VehicleModel->update_vehicle($data, $vehicle_id);
		if ($result) {
			$this->set_alert('success', 'Data Kendaraan berhasil diperbarui');
		}

		redirect(base_url().'kendaraan/detail?id='.$vehicle_id);
	}

	public function delete() {
		$this->validate_referer();
		
		$vehicle_id = $this->input->get('id', TRUE);
		$data = array(
			'status' => 3,
			'update_by' => $this->get_userid(),
			'update_time' => $this->TimeConstant->get_current_timestamp()
		);

		$result = $this->VehicleModel->update_vehicle($data, $vehicle_id);
		if ($result) {
			$this->set_alert('success', 'Data Kendaraan berhasil dihapus');
		}

		redirect(base_url().'kendaraan');
	}
}