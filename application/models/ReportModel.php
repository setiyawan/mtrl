<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ReportModel extends CI_Model {

    public function get_daily_report($filter=[]) {
        $date = $filter['date'];

        $query_paidoff = '';
        if ($filter['is_paid_off'] != '') {
            $query_paidoff = 'AND is_paid_off = ' . $filter['is_paid_off'];
        }

        $sql = "SELECT * FROM (
            SELECT 1 as cashflow_type, invoice_code, date(transaction_time) as date, material_name as description, volume, driver_name, receiver_name, license_plate, is_paid_off, total_price as cashflow_amount, t.create_time as create_time from transaction t 
            join material m on t.material_id = m.material_id
            where date(transaction_time) = '" . $date . "' and t.status = 1 " . $query_paidoff . "
            UNION 
            SELECT cashflow_type, '', date(cashflow_date), description, '', '', '', '', 1, amount, create_time FROM cashflow
            where date(cashflow_date) = '" . $date . "' and status = 1
        ) AS report order by date, create_time asc";

        $sql2 = "SELECT 1 as cashflow_type, invoice_code, date(transaction_time) as date, material_name as description, volume, driver_name, receiver_name, license_plate, is_paid_off, total_price as cashflow_amount, t.create_time as create_time from transaction t 
            join material m on t.material_id = m.material_id
            where date(transaction_time) = '" . $date . "' and t.status = 1 " . $query_paidoff . "
            order by date, create_time asc";

        if ($filter['is_paid_off'] == '0') {
            return $this->db->query($sql2)->result_array();
        }

        return $this->db->query($sql)->result_array();
    }

    public function get_weekly_report() {
        $sql = "SELECT date, sum(total_income) as total_income, sum(total_expense) as total_expense FROM (
            SELECT date(transaction_time) as date, sum(total_price) as total_income, 0 as total_expense from transaction
            WHERE date(transaction_time) > CURRENT_DATE - INTERVAL 7 DAY AND status = 1 and is_paid_off = 1
            group by date(transaction_time)
            UNION 
            SELECT date(cashflow_date), 
            case when cashflow_type = 1 then sum(amount) else 0 end, 
            case when cashflow_type = 2 then sum(amount) else 0 end 
            FROM cashflow
            where  date(cashflow_date) > CURRENT_DATE - INTERVAL 7 DAY and status = 1
            GROUP by date(cashflow_date), cashflow_type
            ) as weekly group by date order by date asc";
        
        return $this->db->query($sql)->result_array();
    }

    public function get_monthly_report($filter=[]) {
        $month = $filter['month'];
        $year = $filter['year'];

        $query_paidoff = '';
        if ($filter['is_paid_off'] != '') {
            $query_paidoff = 'AND is_paid_off = ' . $filter['is_paid_off'];
        }

        $sql = "SELECT * FROM (
            SELECT 1 as cashflow_type, invoice_code, date(transaction_time) as date, material_name as description, volume, driver_name, receiver_name, license_plate, is_paid_off, total_price as cashflow_amount, t.create_time as create_time from transaction t 
            join material m on t.material_id = m.material_id
            where month(transaction_time) = " . $month . " and year(transaction_time) = " . $year . " and t.status = 1 ". $query_paidoff ."
            UNION 
            SELECT cashflow_type, '', date(cashflow_date), description, '', '', '', '', 1, amount, create_time FROM cashflow
            where month(cashflow_date) = " . $month . " and year(cashflow_date) = " . $year . " and status = 1
        ) AS report order by date, create_time asc";

        $sql2 = "SELECT 1 as cashflow_type, invoice_code, date(transaction_time) as date, material_name as description, volume, driver_name, receiver_name, license_plate, is_paid_off, total_price as cashflow_amount, t.create_time as create_time from transaction t 
            join material m on t.material_id = m.material_id
            where month(transaction_time) = " . $month . " and year(transaction_time) = " . $year . " and t.status = 1 ". $query_paidoff ." order by date, create_time asc";
        
        if ($filter['is_paid_off'] == '0') {
            return $this->db->query($sql2)->result_array();
        }

        return $this->db->query($sql)->result_array();
    }


}

?>