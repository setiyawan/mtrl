<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MaterialModel extends CI_Model {

    public function get_material($filter=[]) {
        if (!empty($filter['material_id'])) {
            $this->db->where('material_id', $filter['material_id']);
        }

        if (!empty($filter['material_name'])) {
            $this->db->like('material_name', $filter['material_name']);
        }

        if (!empty($filter['status'])) {
            $this->db->where('status', $filter['status']);
        }

        $this->db->order_by('material_name');

        return  $this->db->get('material')->result_array();
        // print_r($this->db->last_query());  
        // die;
    }

    public function get_latest_material_id() {
        $this->db->select_max('material_id');
        return $this->db->get('material')->row()->material_id;
    }

    public function get_material_count() {
        return $this->db->count_all_results('material');
    }

    // POST TRANSACTION
    public function add_material($data) {
        return $this->db->insert('material', $data);
    }

    public function update_material($data, $material_id){
        $this->db->set($data);
        $this->db->where('material_id', $material_id);
        return $this->db->update('material');
    }

}

?>