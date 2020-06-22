<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ReportModel extends CI_Model {

    public function get_daily_report($filter=[]) {
        $date = $filter['date'];

        $sql = "SELECT * FROM (
            SELECT 1 as cashflow_type, date(transaction_time) as date, material_name as description, volume, total_price as cashflow_amount, t.create_time as create_time from transaction t 
            join material m on t.material_id = m.material_id
            where date(transaction_time) = '" . $date . "' and t.status = 1 and is_paid_off = 1
            UNION 
            SELECT cashflow_type, date(cashflow_date), description, '', amount, create_time FROM cashflow
            where date(cashflow_date) = '" . $date . "' and status = 1
        ) AS report order by date, create_time asc";

        return $this->db->query($sql)->result_array();
        // print_r($this->db->last_query());  
        // die;
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

        $sql = "SELECT * FROM (
            SELECT 1 as cashflow_type, date(transaction_time) as date, material_name as description, volume, total_price as cashflow_amount, t.create_time as create_time from transaction t 
            join material m on t.material_id = m.material_id
            where month(transaction_time) = " . $month . " and year(transaction_time) = " . $year . " and t.status = 1 and is_paid_off = 1
            UNION 
            SELECT cashflow_type, date(cashflow_date), description, '', amount, create_time FROM cashflow
            where month(cashflow_date) = " . $month . " and year(cashflow_date) = " . $year . " and status = 1
        ) AS report order by date, create_time asc";
        
        return $this->db->query($sql)->result_array();
    }


}

?>