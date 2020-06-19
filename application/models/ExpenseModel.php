<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ExpenseModel extends CI_Model {

    public function get_expense($filter=[]) {
        if (!empty($filter['expense_id'])) {
            $this->db->where('expense_id', $filter['expense_id']);
        }

        if (!empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }

        $this->db->order_by('expense_date');

        return  $this->db->get('expense')->result_array();
        // print_r($this->db->last_query());  
        // die;
    }

    public function get_latest_expense_id() {
        $this->db->select_max('expense_id');
        return $this->db->get('expense')->row()->expense_id;
    }

    public function get_expense_count() {
        return $this->db->count_all_results('expense');
    }

    // POST TRANSACTION
    public function add_expense($data) {
        return $this->db->insert('expense', $data);
    }

    public function update_expense($data, $expense_id){
        $this->db->set($data);
        $this->db->where('expense_id', $expense_id);
        return $this->db->update('expense');
    }

}

?>