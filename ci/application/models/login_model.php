<?php

class Login_model extends CI_Model {

    function username($userID) {
        $query = $this->db->get_where('user', array('userID' => $userID));
        if ($query->num_rows == 1) {
            $row = $query->row();
            return $row->username;
        } else {
            return FALSE;
        }
    }

    function validate() {
        $this->db->where('username', html_escape($this->input->post('login_username')));
        $this->db->where('pwd', md5(html_escape($this->input->post('login_pwd'))));
        $query = $this->db->get('user');

        if ($query->num_rows == 1) {
            $row = $query->row();
            $newdata = array(
                'userID' => $row->userID,
                'is_logged_in' => TRUE,
                'username' => $row->username
            );
            //admin login shizzle
            if ($row->extended_view) {
                $newdata['is_admin'] = TRUE;
            }
            $this->session->set_userdata($newdata);
            return $row->userID;
        } else {
            return false;
        }
    }
	
	function validate_password() {
		$this->db->where('userID', $this->session->userdata('userID'));
        $this->db->where('pwd', md5(html_escape($this->input->post('password_old'))));
        $query = $this->db->get('user');

        if ($query->num_rows == 1) {
			return true;
		}
		else {
			return false;
		}
	}

    function isAdmin($userID) {
        $this->db->where('userID', $userID);
        $this->db->where('extended_view', TRUE);
        $query = $this->db->get('user');
        if ($query->num_rows == 1) {
            $newdata = array(
                'userID' => $row->userID,
                'is_logged_in' => TRUE,
            );
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function create_account() {
        $new_account_insert_data = array(
            'username' => html_escape($this->input->post('username')),
            'pwd' => md5(html_escape($this->input->post('pwd'))),
            'mail' => html_escape($this->input->post('mail'))
        );

        $insert = $this->db->insert('user', $new_account_insert_data);

        if ($insert) {
            $this->db->where('username', $new_account_insert_data['username']);
            $this->db->where('pwd', $new_account_insert_data['pwd']);

            $query = $this->db->get('user');
            $account = $query->row();
            $newdata = array(
                'userID' => $account->userID,
                'is_logged_in' => TRUE,
                'username' => $account->username
            );
            $this->session->set_userdata($newdata);
            return TRUE;
        }
        return FALSE;
    }

    function delete_account() {
        $list = $this->db->query(
                'SELECT * 
			FROM `user` 
			WHERE username="' . $this->session->userdata('username') . '";');
        $row = $list->row_array();
        $user = $row['username'];

        if ($user == $this->session->userdata('username')) {
            $q = $this->db->query(
                    'DELETE FROM user 
				WHERE username="' . $this->session->userdata('username') . '";');
            return true;
        }

        else
            return false;
    }
	
	function delete_account_profile($logged_in_userid) {
		$q = $this->db->query(
                    'DELETE FROM user 
				WHERE userID="' . $logged_in_userid . '";');
            return $q;
	}
	
	
	function update_my_password($new_password, $old_password) {
		$logged_in_user = $this->session->userdata('userID');
		$data = array(
             'pwd' => md5(html_escape($new_password))
        );
		
		$this->db->where('userID', $logged_in_user);
		$q = $this->db->update('user', $data); 
		
		return $q;
	}
	
	function update_my_email($new_email) {
		$logged_in_user = $this->session->userdata('userID');
		$data = array(
             'mail' => html_escape($new_email)
        );
		
		$this->db->where('userID', $logged_in_user);
		$q = $this->db->update('user', $data); 
		
		return $q;
	}
	
}
?>