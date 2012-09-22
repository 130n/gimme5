<?php

class delete_list_model extends CI_Model {

//funktion som kollar att den inloggade invändaren har samma userID som listans skapare och tar bort den om så är fallet. 

    function delete_list() {
        unset($listID);
        $listID = $_REQUEST['list_id'];
        $list = $this->db->query(
                'SELECT * 
		FROM `list` 
		WHERE listID=' . $listID . ';');
        $row = $list->row_array();
        $creator = $row['creator'];

        if ($creator == $this->session->userdata('userID')) {
            $q = $this->db->query(
                    'DELETE FROM list 
			WHERE listID=' . $listID . ';');
            return q;
        }

        else
            return false;
    }

}

?>