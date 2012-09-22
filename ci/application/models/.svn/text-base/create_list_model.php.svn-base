<?php

class Create_list_model extends CI_Model {

	

    function create_list() {
		// lägg till title description
		$new_desc_title = array(
            'description' => html_escape($this->input->post('hidden_description_title')),
        );
		$insert = $this->db->insert('listdescription', $new_desc_title);
		$desc_title_id = $this->db->insert_id();
	
	
        $new_list_insert_data = array(
            'title' => html_escape($this->input->post('title')),
            'creator' => $this->session->userdata('userID'),
            'category' => $this->input->post('category'),
			'listdescription' => $desc_title_id,
        );
		
		
		
		// Bygga taggar av rubriken
        $list_title=html_escape($this->input->post('title'));
        $title_tags=explode(" ", $list_title);

		


		//Lägg till listan
        $insert = $this->db->insert('list', $new_list_insert_data);
        $id = $this->db->insert_id();


       
        if ($this->input->post('tags') != 'Tags' ) {
            $tags = explode(', ', html_escape($this->input->post('tags')));
            $exploded_tags = array_merge((array)$title_tags, (array)$tags);
        }
        else {
			$exploded_tags=$title_tags;

        }


        // gör allt i arrayen till små bokstäver
		$exploded_tags = array_map("strtolower", $exploded_tags);

		//tar bort dubletter
        $exploded_tags= array_unique($exploded_tags);
          
            foreach ($exploded_tags as $tag) {
                //kolla efter tag i db
                $this->db->where('tagname', $tag);
                $q_exists = $this->db->get('tag');
                if ($q_exists->num_rows > 0) {
                    $this->db->insert('listtag', array('tag' => $tag, 'list' => $id));
                } else {
                    $this->db->insert('tag', array('tagname' => $tag));
                    $this->db->insert('listtag', array('tag' => $tag, 'list' => $id));
                }
            }
        

        // En array med de poster som användaren angett 
        $new_list_insert_posts = array(
            'post1' => html_escape($this->input->post('post1')),
            'post2' => html_escape($this->input->post('post2')),
            'post3' => html_escape($this->input->post('post3')),
            'post4' => html_escape($this->input->post('post4')),
            'post5' => html_escape($this->input->post('post5'))
        );
		
		
        

		
		// lägg till description 1
		$new_desc_post_1 = array(
            'description' => html_escape($this->input->post('hidden_description_desc1')),
        );
		$insert = $this->db->insert('description', $new_desc_post_1);
		$desc_1_id = $this->db->insert_id();
		
		// lägg till description 2
		$new_desc_post_2 = array(
            'description' => html_escape($this->input->post('hidden_description_desc2')),
        );
		$insert = $this->db->insert('description', $new_desc_post_2);
		$desc_2_id = $this->db->insert_id();
		
		// lägg till description 3
		$new_desc_post_3 = array(
            'description' => html_escape($this->input->post('hidden_description_desc3')),
        );
		$insert = $this->db->insert('description', $new_desc_post_3);
		$desc_3_id = $this->db->insert_id();
		
		// lägg till description 4
		$new_desc_post_4 = array(
            'description' => html_escape($this->input->post('hidden_description_desc4')),
        );
		$insert = $this->db->insert('description', $new_desc_post_4);
		$desc_4_id = $this->db->insert_id();
		
		// lägg till description 5
		$new_desc_post_5 = array(
            'description' => html_escape($this->input->post('hidden_description_desc5')),
        );
		$insert = $this->db->insert('description', $new_desc_post_5);
		$desc_5_id = $this->db->insert_id();

	
        //post1
        $q = $this->db->query("INSERT INTO  `" . $this->db->database . "`.`listpost` (`listpostid` ,`list` ,`post` ,`rank`, `description`)
		VALUES (NULL ,  '{$id}',  '{$new_list_insert_posts['post1']}',1, '{$desc_1_id}');");

        //post2
        $q = $this->db->query("INSERT INTO  `" . $this->db->database . "`.`listpost` (`listpostid` ,`list` ,`post` ,`rank`, `description`)
		VALUES (NULL ,  '{$id}',  '{$new_list_insert_posts['post2']}',2, '{$desc_2_id}');");

        //post3
        $q = $this->db->query("INSERT INTO  `" . $this->db->database . "`.`listpost` (`listpostid` ,`list` ,`post` ,`rank`, `description`)
		VALUES (NULL ,  '{$id}',  '{$new_list_insert_posts['post3']}',3, '{$desc_3_id}');");

        //post4
        $q = $this->db->query("INSERT INTO  `" . $this->db->database . "`.`listpost` (`listpostid` ,`list` ,`post` ,`rank`, `description`)
		VALUES (NULL ,  '{$id}',  '{$new_list_insert_posts['post4']}',4, '{$desc_4_id}');");


        //post5
        $q = $this->db->query("INSERT INTO  `" . $this->db->database . "`.`listpost` (`listpostid` ,`list` ,`post` ,`rank`, `description`)
		VALUES (NULL ,  '{$id}',  '{$new_list_insert_posts['post5']}',5, '{$desc_5_id}');");

        return TRUE;
    }

    function get_category_dropdown() {
        $this->db->from('category');
        $this->db->order_by('catname');
        $result = $this->db->get();
        $return = array();
        if ($result->num_rows() > 0) {
            $return[''] = 'Välj kategori';
            foreach ($result->result_array() as $row) {
                $return[$row['catname']] = $row['catname'];
            }
        }
        return $return;
    }
	
	function update_desc() {
		$listans_id =$this->input->post('listans_id');
		$ranken =$this->input->post('da_rank');
			
			$this->db->from('listpost');
			$this->db->where('rank', $ranken);
			$this->db->where('list', $listans_id);
			
			$query = $this->db->get();
			
			$data = array(
               'description' => $this->input->post('description' . $ranken . '')
            );
			
			
			$row = $query->row_array();
			$desc = $row['description'];
				
			$this->db->where('descriptionID', $desc);
			$this->db->update('description', $data); 
			return $ranken;
	}


}
?>
