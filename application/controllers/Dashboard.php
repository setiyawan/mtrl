<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

class Dashboard extends My_Controller {

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
    	$filter = array(
    		'transaction_month' => $this->TimeConstant->get_current_month(),
    		'transaction_year' => $this->TimeConstant->get_current_year(),
    		'vehicle_expired_month' => $this->TimeConstant->get_current_month(),
    		'vehicle_expired_year' => $this->TimeConstant->get_current_year(),
    		'status' => 1
    	);

    	$total_income = 0;
    	$total_expense = 0;
    	$total_trx = 0;
    	$total_material = 0;

    	$transaction = $this->TransactionModel->get_transaction_dashboard($filter);
    	$expired_vehicle = $this->VehicleModel->get_vehicle_count($filter);

    	foreach ($transaction as $key => $value) {
    		$total_income += $value['total_price'];
    		$total_trx += 1;
    		$total_material += $value['volume'];
    	}

    	$data = array(
    		'add_js' => 'dashboard1',
    		'total_income' => $this->Converter->to_rupiah($total_income),
    		'total_trx' => $total_trx,
    		'total_material' => $total_material,
    		'total_vehicle_expired' => $expired_vehicle
    	);

		$this->load->view('dashboard', $data);
	}

	public function get_sales_overview() {
		$overview = $this->ReportModel->get_weekly_report();
		foreach ($overview as $key => $value) {
			$label[$key] = date('d/m',strtotime($value['date']));
			$income[$key] = $value['total_income'];
			$expense[$key] = $value['total_expense'];
			$total_income += $value['total_income'];
			$total_expense += $value['total_expense'];
		}

		$data = array(
			'label' => $label,
			'income' => $income,
			'expense' => $expense,
			'total_income' => $total_income,
			'total_expense' => $total_expense,
			'total_income_idr' => $this->Converter->to_rupiah($total_income),
			'total_expense_idr' => $this->Converter->to_rupiah($total_expense),
		);

		// var_dump($overview);
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}