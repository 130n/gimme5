<?php

class Membership extends CI_Controller {

    function logout() {
        $this->session->sess_destroy();
        redirect('site');
    }

    /**
     * VALIDATE CREDENTIALS
     * */
    function validate_credentials() {
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

        /*
         * REGLER
         * anvnamn: 4-12 tecken
         */
        $data['username_rules'] = $this->form_validation->set_rules(
                'login_username', 'användarnamn', 'trim|required|min_length[4]|max_length[12]|callback_valid_login_check');
        /*
         * pwd: 4- tecken
         */
        $data['password_rules'] = $this->form_validation->set_rules(
                'login_pwd', 'lösenord', 'trim|required|min_length[4]|max_length[32]');

        /**
         * 	LOGIN FORM VALIDATION
         * */
        if ($this->form_validation->run() == FALSE) { // något är fel, ladda om sidan
            $this->session->set_flashdata('validation_errors', validation_errors());

            redirect('site');
        } else { //Login successful
            if ($this->session->userdata('is_admin')) {
                redirect('admin');
            } else {
                redirect('site');
            }
        }
    }

    /**
     * CREATE ACCOUNT
     * */
    function create_account() {
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

        /** Sätter regler för de olika fälten.
         * Första variablen är 'name'. 
         * Andra är vad fältet kallas i error-meddelanden. Resten är regler.
         * Regler create account
         * */
        $this->form_validation->set_rules(
                'username', 'användarnamn', 'trim|required|min_length[4]|max_length[12]|is_unique[user.username]');
        $this->form_validation->set_rules(
                'pwd', 'lösenord', 'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules(
                'mail', 'epost-adress', 'trim|required|valid_email|is_unique[user.mail]|max_length[40]');
        $this->form_validation->set_rules(
                'pwd2', 'bekräfta lösenord', 'trim|required|matches[pwd]');
        $this->form_validation->set_rules(
                'agreeCheck', 'att du accepterat användarvillkoren', 'required');
        /**
         * 	SIGNUP FORM VALIDATION
         * */
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('signup_validation_errors', validation_errors());
            $this->session->set_flashdata('signup_error_username', form_error('username'));
            $this->session->set_flashdata('signup_error_email', form_error('mail'));
            $this->session->set_flashdata('signup_error_password', form_error('pwd'));
            $this->session->set_flashdata('signup_error_password2', form_error('pwd2'));
            $this->session->set_flashdata('signup_error_agreeCheck', form_error('agreeCheck'));

            $this->session->set_flashdata('signup_value_username', set_value('username', 'username'));
            $this->session->set_flashdata('signup_value_email', set_value('mail', 'email'));
            $this->session->set_flashdata('signup_value_pwd', set_value('pwd', 'password'));
            $this->session->set_flashdata('signup_value_pwd2', set_value('pwd2', 'password'));
            $this->session->set_flashdata('signup_value_checkbox', set_value('agreeCheck', FALSE));

            redirect('site');
        } else {
            $this->load->model('login_model');
            if ($query = $this->login_model->create_account() == TRUE) {
                $valid = $this->login_model->validate();
                redirect('site');
            } else {
                redirect('site/error_message');
            }
        }
    }

    public function valid_login_check($str) {
        $this->load->model('login_model');
        $valid = $this->login_model->validate();

        if (!$valid) {
            $this->form_validation->set_message(
                    'valid_login_check', 'Fel användarnamn eller lösnord.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
	public function valid_password_check($str) {
        $this->load->model('login_model');
		
		/* 
							login_model->validate_password()
		funktion som kollar ifall det finns en rad i databasen som innehåller både
		den inloggade invändarens användarnamn och det lösenord som skickats med.
		Returnerar isåfall true, annars false.
		*/
        $valid = $this->login_model->validate_password();

        if (!$valid) {
            $this->form_validation->set_message(
                    'valid_password_check', 'Det gamla lösenordet du angav stämde inte.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //tar bort kontot, och profileilden
	function delete_account() {
        $this->load->model('login_model');
		$logged_in_userid = $this->session->userdata('userID');

        if($this->login_model->delete_account_profile($logged_in_userid)) {
			// Logga ut från det borttagna kontot, nödvändigt då informationen fortfarande finns kvar i cockien.
			$this->session->sess_destroy();
			// Tar bort användarens bild, för att spara utrymme på servern
			$this->load->model('profile_model');
			$this->profile_model->remove_pic();
			//redirect till startsidan
			redirect('site');
		}
		else {
			// nåt blev fel i queryt, redirect 404
			redirect('site/error_message');
		}
    }
	
	function update_password() {
		// tar emot adressen man kom ifrån
		$redirect_url = $this->input->post('hidden_url');
	
		// errors
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->form_validation->set_rules('password_update', 'ett nytt lösenord',
			   'trim|required|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('password_old', 'ditt gamla lösenord', 
			   'trim|required|callback_valid_password_check');
			  
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('update_profile_validation_errors', validation_errors());
			$this->session->set_flashdata('update_password_error', form_error('password_update'));
			$this->session->set_flashdata('old_password_error', form_error('password_old'));
			redirect($redirect_url);
		}
		else {
        $this->load->model('login_model');
		$new_password = $this->input->post('password_update');
		$old_password = $this->input->post('password_old');
			if($this->login_model->update_my_password($new_password, $old_password)) {
				// redirect till där man var innan
				redirect($redirect_url);
			}
			else {
				// nåt blev fel i queryt, redirect 404 (för att undvika SQL error)
				redirect('site/error_message');
			}
		}
    }
	
	function update_email() {
		// tar emot adressen man kom ifrån
		$redirect_url = $this->input->post('hidden_url');
	
		// error validering, set rules, test
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		$this->form_validation->set_rules('email_update', 'epost-adress',
              'trim|required|valid_email|is_unique[user.mail]|max_length[40]');
			  
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('update_profile_validation_errors', validation_errors());
			$this->session->set_flashdata('update_email_error', form_error('email_update'));
			redirect($redirect_url);
		}
		else {
			$this->load->model('login_model');
			$new_email = $this->input->post('email_update');
			
			// kör update queryt
			if($this->login_model->update_my_email($new_email)) {
				// redirect till profilen man kom ifrån, skickas med som en hidden_form
				redirect($redirect_url);
			
			}
			else {
				// nåt blev fel i queryt, redirect 404
				redirect('site/error_message');
			}
		}
    }

    // Tar bort den inloggade användarens bild
    function remove_pic() {
        $this->load->model('profile_model');

        if($this->profile_model->remove_pic()) {
			redirect('site/profile');
		}
		else {
			redirect('site/error_message');
		}
       
    }
}
?>