<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Laporan extends My_Controller {

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
    	redirect(base_url().'laporan/bulanan');
	}

	function harian() {
		$get = $this->input->get();

    	$filter = array(
    		'date' => $this->Ternary->isempty_value($get['date'], $this->TimeConstant->get_current_month()),
	    	'filter_search' => 'daily_report'
	    );

    	$data = array(
    		'active_page' => 'report',
    		'active_sub_page' => 'daily_report',
    		'page_title' => 'Laporan Harian',
			'parent_page' => 'Home',
			'page_child' => 'Data Laporan',
			'parent_page_url' => base_url(),
			'filter' => $filter,
    		'report' => $this->ReportModel->get_daily_report($filter)
    	);

		$this->load->view('report', $data);
	}

	function bulanan() {
		$get = $this->input->get();

    	$filter = array(
    		'month' => $this->Ternary->isempty_value($get['month'], $this->TimeConstant->get_current_month()),
	    	'year' => $this->Ternary->isempty_value($get['year'], $this->TimeConstant->get_current_year()),
	    	'filter_search' => 'monthly_report'
	    );

    	$data = array(
    		'active_page' => 'report',
    		'active_sub_page' => 'monthly_report',
    		'page_title' => 'Laporan Bulanan',
			'parent_page' => 'Home',
			'page_child' => 'Data Laporan',
			'parent_page_url' => base_url(),
			'filter' => $filter,
    		'report' => $this->ReportModel->get_monthly_report($filter)
    	);

		$this->load->view('report', $data);
	}
}