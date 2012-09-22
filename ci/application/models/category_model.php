<?php

class Category_model extends CI_Model {

    function get_categories() {
        $q = $this->db->get('category');
        foreach ($q->result() as $row) {
            $categories[] = $row;
        }
        return $categories;
    }

}

?>