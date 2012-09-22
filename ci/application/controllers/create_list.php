<?php
class Create_list extends CI_Controller {

    function make_list() {
        $this->load->model('create_list_model');

        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');

        /*
         * REGLER
         * Första variablen är 'name'.
         * Andra är vad fältet kallas i error-meddelanden. 
         * Resten är regler.
         */
        $this->form_validation->set_rules('title', 'en Titel på din lista',
         'trim|required|min_length[1]|max_length[38]|xss_clean|callback_disallowed_posts');

        $this->form_validation->set_rules('post1', 'något som nummer 1 på din lista',
         'trim|required|min_length[1]|max_length[38]|xss_clean|callback_disallowed_posts');
        $this->form_validation->set_rules('post2', 'något som nummer 2 på din lista',
         'trim|required|min_length[1]|max_length[38]|xss_clean|callback_disallowed_posts');
        $this->form_validation->set_rules('post3', 'något som nummer 3 på din lista',
         'trim|required|min_length[1]|max_length[38]|xss_clean|callback_disallowed_posts');
        $this->form_validation->set_rules('post4', 'något som nummer 4 på din lista',
         'trim|required|min_length[1]|max_length[38]|xss_clean|callback_disallowed_posts');
        $this->form_validation->set_rules('post5', 'något som nummer 5 på din lista',
         'trim|required|min_length[1]|max_length[38]|xss_clean|callback_disallowed_posts');
		
		$this->form_validation->set_rules('hidden_description_title', 'title description',
         'trim|max_length[300]|xss_clean');
        $this->form_validation->set_rules('hidden_description_desc1', 'description 1',
         'trim|max_length[300]|xss_clean');
        $this->form_validation->set_rules('hidden_description_desc2', 'description 2',
         'trim|max_length[300]|xss_clean');
        $this->form_validation->set_rules('hidden_description_desc3', 'description 3',
         'trim|max_length[300]|xss_clean');
        $this->form_validation->set_rules('hidden_description_desc4', 'description 4',
         'trim|max_length[300]|xss_clean');
        $this->form_validation->set_rules('hidden_description_desc5', 'description 5',
         'trim|max_length[300]|xss_clean');
        $this->form_validation->set_rules('category', 'en kategori', 
            'trim|required');
        $this->form_validation->set_rules('tags', 'taggar', 
            'trim|xss_clean|callback_tags_length');

        /*
         * Här sätts all flashdata med fel och värden som ska
         *
         */
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('list_validation_errors', validation_errors());
            //title + list description
            $this->session->set_flashdata('create_list_error_title', form_error('title'));
            $this->session->set_flashdata(
                'create_list_error_title_desc', form_error('title_description'));
            /*
             * sätter flashdata errors för poster
             */
            $this->session->set_flashdata('create_list_error_post1', 
                form_error('post1'));
            $this->session->set_flashdata('create_list_error_post2', 
                form_error('post2'));
            $this->session->set_flashdata('create_list_error_post3', 
                form_error('post3'));
            $this->session->set_flashdata('create_list_error_post4', 
                form_error('post4'));
            $this->session->set_flashdata('create_list_error_post5', 
                form_error('post5'));
            /*
             * sätter flashdata errors för beskrivningar
             */
            $this->session->set_flashdata('create_list_error_desc1', 
                form_error('hidden_description_desc1'));
            $this->session->set_flashdata('create_list_error_desc2', 
                form_error('hidden_description_desc2'));
            $this->session->set_flashdata('create_list_error_desc3', 
                form_error('hidden_description_desc3'));
            $this->session->set_flashdata('create_list_error_desc4', 
                form_error('hidden_description_desc4'));
            $this->session->set_flashdata('create_list_error_desc5', 
                form_error('hidden_description_desc5'));
            $this->session->set_flashdata('create_list_error_category', 
                form_error('category'));
            $this->session->set_flashdata('create_list_error_tags', 
                form_error('tags'));


            /*
             * sätter flashdata värden för poster
             */
			 
            $this->session->set_flashdata('create_list_value_title', 
                set_value('title', 'Write your heading here'));
            $this->session->set_flashdata('create_list_value_post1', 
                set_value('post1', 'Första posten'));
            $this->session->set_flashdata('create_list_value_post2', 
                set_value('post2', 'Andra posten'));
            $this->session->set_flashdata('create_list_value_post3', 
                set_value('post3', 'Tredje posten'));
            $this->session->set_flashdata('create_list_value_post4', 
                set_value('post4', 'Fjärde posten'));
            $this->session->set_flashdata('create_list_value_post5', 
                set_value('post5', 'Femte posten'));
			
            /*
            * sätter flashdata värden för beskrivningar
            */
            $this->session->set_flashdata('create_list_value_title_desc', 
                set_value('hidden_description_title'));
            $this->session->set_flashdata('create_list_value_desc1', 
                set_value('hidden_description_desc1'));
            $this->session->set_flashdata('create_list_value_desc2', 
                set_value('hidden_description_desc2'));
            $this->session->set_flashdata('create_list_value_desc3', 
                set_value('hidden_description_desc3'));
            $this->session->set_flashdata('create_list_value_desc4', 
                set_value('hidden_description_desc4'));
            $this->session->set_flashdata('create_list_value_desc5', 
                set_value('hidden_description_desc5'));

/*
*   lagrar strängen i flashdata
*/
            $this->session->set_flashdata('value_desc1', 
                $this->input->post('hidden_description_desc1'));
            $this->session->set_flashdata('value_desc2', 
                $this->input->post('hidden_description_desc2'));
            $this->session->set_flashdata('value_desc3', 
                $this->input->post('hidden_description_desc3'));
            $this->session->set_flashdata('value_desc4', 
                $this->input->post('hidden_description_desc4'));
            $this->session->set_flashdata('value_desc5', 
                $this->input->post('hidden_description_desc5'));
			
            $this->session->set_flashdata('category_value', set_value('category'));
            $this->session->set_flashdata('create_list_value_tags', set_value('tags', 'Tags'));
            redirect('site/create_list');
        } else {
            if ($query = $this->create_list_model->create_list() == TRUE) {
                redirect('site');
            } else {
                redirect('site/error_message');
            }
        }
    }

    public function disallowed_posts($str){
        $dis_array = array(
            "Skriv din rubrik här",
            "Första posten",
            "Andra posten",
            "Tredje posten",
            "Fjärde posten",
            "Femte posten"
        );
        if(in_array($str, $dis_array)){
            $this->form_validation->set_message(
                    'disallowed_posts', 'Du måste fylla i %s.');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }

    public function tags_length($str){
        $tags=explode(', ',$str);
        $num = count($tags);
        for ($i = 0; $i < $num; $i++) {
            if(strlen($tags[$i])>30){
                $this->form_validation->set_message(
                    'tags_length', 'En tag i %sfältet får inte vara längre än 30 tecken.');
                return FALSE;
            }
        }
        return TRUE;
    }
	
	function make_description() {
    	$this->load->view('create_list_view');
    	
    	if($this->input->post('title_description') == null) {
    		$title_desc = $this->session->flashdata('create_list_value_title_desc');
    	}
    	else {
    		$title_desc = $this->input->post('title_description');
    	}
    	
    	if($this->input->post('description1') == null) {
    		$desc1 = $this->session->flashdata('create_list_value_desc1');
    	}
    	else {
    		$desc1 = $this->input->post('description1');
    	}
    	
    	if($this->input->post('description2') == null) {
    		$desc2 = $this->session->flashdata('create_list_value_desc2');
    	}
    	else {
    		$desc2 = $this->input->post('description2');
    	}
    	
    	
    	if($this->input->post('description3') == null) {
    		$desc3 = $this->session->flashdata('create_list_value_desc3');
    	}
    	else {
    		$desc3 = $this->input->post('description3');
    	}
    	
    	
    	if($this->input->post('description4') == null) {
    		$desc4 = $this->session->flashdata('create_list_value_desc4');
    	}
    	else {
    		$desc4 = $this->input->post('description4');
    	}
    	
    	
    	if($this->input->post('description5') == null) {
    		$desc5 = $this->session->flashdata('create_list_value_desc5');
    	}
    	else {
    		$desc5 = $this->input->post('description5');
    	}

    	/* FUNKAR INTE :(
    	$post_1 = $_POST["post1"];
    	$this->session->set_flashdata('create_list_value_post1', set_value('post1', $post_1));
    	
    	*/
    	redirect('site/create_list');
	}
	
	function update_description() {
		$this->load->model('create_list_model');
		
		if ($query = $this->create_list_model->update_desc() == TRUE) {
            redirect('site');
        } 
		else {
            redirect('site/error_message');
        }
	
	}
}
?>