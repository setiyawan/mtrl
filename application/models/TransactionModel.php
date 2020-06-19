<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class TransactionModel extends CI_Model {

    public function get_transaction($filter=[]) {
        if (!empty($filter['transaction_id'])) {
            $this->db->where('transaction_id', $filter['transaction_id']);
        }

        if (!empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }

        return  $this->db->get('transaction')->result_array();
    }

    public function get_transaction_dashboard($filter=[]) {
        if (!empty($filter['transaction_date'])) {
            $this->db->where('date(transaction_time)', $filter['transaction_date']);
        }

        if (!empty($filter['transaction_month']) && !empty($filter['transaction_year'])) {
            $this->db->where('month(transaction_time)', $filter['transaction_month']);
            $this->db->where('year(transaction_time)', $filter['transaction_year']);
        }

        if (!empty($filter['status'])) {
            $this->db->where('t.status', $filter['status']);
        }

        $this->db->join('material m', 'm.material_id = t.material_id');
        return  $this->db->get('transaction t')->result_array();
    }

    public function get_transaction_invoice($filter=[]) {
        if (!empty($filter['transaction_id'])) {
            $this->db->where('transaction_id', $filter['transaction_id']);
        }

        $this->db->select('t.*, m.material_name, v.length, v.height, v.width', FALSE);
        $this->db->join('material m', 'm.material_id = t.material_id');
        $this->db->join('vehicle v', 'v.vehicle_id = t.vehicle_id');
        return  $this->db->get('transaction t')->result_array();
    }

    public function get_latest_transaction_id() {
        $this->db->select_max('transaction_id');
        return $this->db->get('transaction')->row()->transaction_id;
    }

    public function get_transaction_count() {
        return $this->db->count_all_results('transaction');
    }

    // POST TRANSACTION
    public function add_transaction($data) {
        return $this->db->insert('transaction', $data);
    }

    public function update_transaction($data, $transaction_id){
        $this->db->set($data);
        $this->db->where('transaction_id', $transaction_id);
        return $this->db->update('transaction');
    }

}

?>