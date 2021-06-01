<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/controllers/MyController.php';

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
    		'date' => $this->Ternary->isempty_value($get['date'], date('Y-m-d')),
    		'is_paid_off' => $get['is_paid_off'],
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
	    	'is_paid_off' => $get['is_paid_off'],
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

	public function cetak() {
		$get = $this->input->get();

		if ($get['type'] == 'daily') {
			$filter = array(
	    		'date' => $this->Ternary->isempty_value($get['date'], date('Y-m-d')),
    			'is_paid_off' => $get['is_paid_off']
		    );

		    $data = array(
		    	'report_title' => 'Laporan Harian',
		    	'report_time' => $this->Converter->to_indonesia_date_full($filter['date']),
		    	'report' => $this->ReportModel->get_daily_report($filter)
		    );
		} else if ($get['type'] == 'monthly') {
			$filter = array(
	    		'month' => $this->Ternary->isempty_value($get['month'], $this->TimeConstant->get_current_month()),
	    		'year' => $this->Ternary->isempty_value($get['year'], $this->TimeConstant->get_current_year()),
	    		'is_paid_off' => $get['is_paid_off']
		    );

		    $data = array(
		    	'report_title' => 'Laporan Bulanan',
		    	'report_time' => $this->Converter->to_indonesia_full_month((int)$filter['month']) . ' ' . $filter['year'],
		    	'report' => $this->ReportModel->get_monthly_report($filter)
		    );
		}

		$data['user_full_name'] = $this->get_session_by_id('full_name');
		$this->load->view('report_print', $data);
	}

	public function download() {
		$get = $this->input->get();

		if ($get['type'] == 'daily') {
			$filter = array(
	    		'date' => $this->Ternary->isempty_value($get['date'], date('Y-m-d')),
    			'is_paid_off' => $get['is_paid_off']
		    );

		    $data = $this->ReportModel->get_daily_report($filter);
		} else if ($get['type'] == 'monthly') {
			$filter = array(
	    		'month' => $this->Ternary->isempty_value($get['month'], $this->TimeConstant->get_current_month()),
	    		'year' => $this->Ternary->isempty_value($get['year'], $this->TimeConstant->get_current_year()),
	    		'is_paid_off' => $get['is_paid_off']
		    );

		    $data = $this->ReportModel->get_monthly_report($filter);
		}

		$spreadsheet = new Spreadsheet(); // instantiate Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();

        $kolom = 1;
        $spreadsheet->setActiveSheetIndex(0)
          ->setCellValue('A' . $kolom, 'No')
          ->setCellValue('B' . $kolom, 'Tanggal Transaksi')
          ->setCellValue('C' . $kolom, 'No Nota')
          ->setCellValue('D' . $kolom, 'Keterangan')
          ->setCellValue('E' . $kolom, 'Volume')
          ->setCellValue('F' . $kolom, 'Sopir')
          ->setCellValue('G' . $kolom, 'Plat Nomor')
          ->setCellValue('H' . $kolom, 'Penerima')
          ->setCellValue('I' . $kolom, 'Pemasukan')
          ->setCellValue('J' . $kolom, 'Pengeluaran')
          ->setCellValue('K' . $kolom, 'Balance')
          ->setCellValue('L' . $kolom, 'Status');


        $kolom++;
        $nomor = 1;
        foreach($data as $value) {
        	$volume = '';
            $value['total_income'] = $value['cashflow_type'] == 1 ? $value['cashflow_amount'] : 0;
            $value['total_expense'] = $value['cashflow_type'] == 2 ? $value['cashflow_amount'] : 0;

            $total_income += $value['total_income'];
            $total_expense += $value['total_expense'];
            $balance = $balance + $value['total_income'] - $value['total_expense'];

           	$spreadsheet->setActiveSheetIndex(0)
               ->setCellValue('A' . $kolom, $nomor)
               ->setCellValue('B' . $kolom, $value['create_time'])
               ->setCellValue('C' . $kolom, $value['invoice_code'])
               ->setCellValue('D' . $kolom, $value['description'])
               ->setCellValue('E' . $kolom, $value['volume'])
               ->setCellValue('F' . $kolom, $value['driver_name'])
               ->setCellValue('G' . $kolom, $value['receiver_name'])
               ->setCellValue('H' . $kolom, $value['license_plate'])
               ->setCellValue('I' . $kolom, $value['total_income'])
               ->setCellValue('J' . $kolom, $value['total_expense'])
               ->setCellValue('K' . $kolom, $balance)
               ->setCellValue('L' . $kolom, $this->TransactionConstant->get_paidoff_status()[$value['is_paid_off']]);
	       	$kolom++;
	       	$nomor++;
        }

        $writer = new Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = 'Download Report per ' . $this->TimeConstant->get_current_timestamp(); // set filename for excel file to be exported
 
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 
	}
}