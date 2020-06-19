<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ReportModel extends CI_Model {

    public function get_daily_report($filter=[]) {
        $date = $filter['date'];

        $sql = "SELECT * FROM (
            SELECT 1 as report_type, date(transaction_time) as date, total_price as total_income, 0 as total_expense from transaction
            where date(transaction_time) = '" . $date . "' and status = 1
            UNION 
            SELECT 2, date(expense_date), 0, amount FROM expense
            where date(expense_date) = '" . $date . "' and status = 1
        ) AS report order by date asc";
       
        return $this->db->query($sql)->result_array();
        // print_r($this->db->last_query());  
        // die;
    }

    public function get_weekly_report() {
        $sql = "SELECT date, sum(total_income) as total_income, sum(total_expense) as total_expense FROM (
            SELECT date(transaction_time) as date, sum(total_price) as total_income, 0 as total_expense from transaction
            WHERE date(transaction_time) > CURRENT_DATE - INTERVAL 7 DAY AND status = 1
            group by date(transaction_time)
            UNION 
            SELECT date(expense_date), 0, sum(amount) as amount FROM expense
            where  date(expense_date) > CURRENT_DATE - INTERVAL 7 DAY and status = 1
            GROUP by date(expense_date)
            ) as weekly group by date order by date asc";
        
        return $this->db->query($sql)->result_array();
    }

    public function get_monthly_report($filter=[]) {
        $month = $filter['month'];
        $year = $filter['year'];

        $sql = "SELECT * FROM (
            SELECT 1 as report_type, date(transaction_time) as date, total_price as total_income, 0 as total_expense from transaction
            where month(transaction_time) = " . $month . " and year(transaction_time) = " . $year . " and status = 1
            UNION 
            SELECT 2, date(expense_date), 0, amount FROM expense
            where month(expense_date) = " . $month . " and year(expense_date) = " . $year . " and status = 1
        ) AS report order by date asc";
        
        return $this->db->query($sql)->result_array();
        // print_r($this->db->last_query());  
        // die;
    }


}

?>