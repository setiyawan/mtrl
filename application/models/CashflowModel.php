<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class CashflowModel extends CI_Model {

    public function get_cashflow($filter=[]) {
        if (!empty($filter['cashflow_id'])) {
            $this->db->where('cashflow_id', $filter['cashflow_id']);
        }

        if (!empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }

        if (!empty($filter['cashflow_type'])) {
            $this->db->where('cashflow_type', $filter['cashflow_type']);
        }

        if (!empty($filter['date'])) {
            $this->db->where('cashflow_date', $filter['date']);
        }

         if (!empty($filter['cashflow_month']) && !empty($filter['cashflow_year'])) {
            $this->db->where('month(cashflow_date)', $filter['cashflow_month']);
            $this->db->where('year(cashflow_date)', $filter['cashflow_year']);
        }

        $this->db->order_by('cashflow_date, create_time asc');

        return  $this->db->get('cashflow')->result_array();
        // print_r($this->db->last_query());  
        // die;
    }

    public function get_latest_cashflow_id() {
        $this->db->select_max('cashflow_id');
        return $this->db->get('cashflow')->row()->cashflow_id;
    }

    public function get_cashflow_count() {
        return $this->db->count_all_results('cashflow');
    }

    // POST TRANSACTION
    public function add_cashflow($data) {
        return $this->db->insert('cashflow', $data);
    }

    public function update_cashflow($data, $cashflow_id){
        $this->db->set($data);
        $this->db->where('cashflow_id', $cashflow_id);
        return $this->db->update('cashflow');
    }

}

?>