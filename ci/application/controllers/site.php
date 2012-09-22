﻿<?php

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->flashdata('visited')) {
            $this->session->keep_flashdata('visited');
        } else {
            $data = array(
                'ip' => $this->session->userdata('ip_address'),
                'userid' => $this->session->userdata('userID')
            );
            $this->db->insert('visit', $data);

            $this->session->set_flashdata('visited', TRUE);
        }
    }

    function index() {
        $this->load->model('list_model');
        $data['row'] = $this->list_model->getAll();
        $data['menu'] = 'startsida';
        $data['tab_page'] = 'latest_lists';
        //för att list_view ska kunna återanvändas för older
        $data['from']=FALSE;
        $data['older']='older';
        $data['like'] = $this->list_model->getLikes($data);
        $data['comment'] = $this->list_model->getComments($data);
        $data['title'] = 'Gimme5: Startpage';

        $member = $this->session->userdata('is_logged_in');

        /*
         * Laddar views
         */
        //skickar titel
        $this->load->view('includes/header', $data);
        $this->load->model('create_list_model');
        $data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
        $this->load->view('top_view', $data);

        $this->load->view('menu/menu_view', $data);
        //skickar row
        if ($member) {
            $this->load->view('tab_view');
        }
        $data['rubrik']='Senaste listor';
        $this->load->view('list_view', $data);
        if (!$member) {
            $this->load->view('login_view');
        } else {

            $this->load->model('profile_model');

            //hämtar vänner 
            $friends['friend'] = $this->profile_model->getFriends($this->session->userdata('userID'));

            //hämtar vänförfrågningar
            $friends['request'] = $this->profile_model->get_friend_requests($this->session->userdata('userID'));

            $this->load->view('inloggad_sidebar', $friends);
        }
        $this->load->view('includes/footer');
    }

    function show_404(){
        $data['title'] = 'Gimme5: 404';
        $this->load->view('includes/header', $data);
        $this->load->view('404_view');
        $this->load->view('includes/footer');
    }

    function older($page=NULL) {
        if($page===NULL){
            redirect('site/show_404');
        }
        else{
            if($page==0){
                redirect('site');
            }
            $data['from']=$page;
            $data['older']='older';
            $this->load->model('list_model');
            $data['row'] = $this->list_model->getOlder($page);
            $data['menu'] = 'startsida';
            //hämtar kommentarer
            $data['like'] = $this->list_model->getLikes($data);
            $data['comment'] = $this->list_model->getComments($data);
            $data['title'] = 'Gimme5: Äldre listor sida '.$page;
			$data['rubrik'] = 'Senaste listor';

            $data['empty'] = 'Det finns inga äldre listor';
            $member = $this->session->userdata('is_logged_in');
            /*
             * Laddar views
             */
            $this->load->view('includes/header', $data);
            $this->load->model('create_list_model');
        $data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
        $this->load->view('top_view', $data);
            $this->load->view('menu/menu_view', $data);
            $this->load->view('tab_view');
            $this->load->view('list_view', $data);

            if (!$member) {
                $this->load->view('login_view');
            } else {
                $this->load->model('profile_model');

                //hämtar vänner 
                $friends['friend'] = $this->profile_model->getFriends($this->session->userdata('userID'));

                //hämtar vänförfrågningar
                $friends['request'] = $this->profile_model->get_friend_requests($this->session->userdata('userID'));

                $this->load->view('inloggad_sidebar', $friends);
            }
            $this->load->view('includes/footer');
        }
    }

    function user_agreement() {
        $this->load->view('user_agreement_view');
    }

    function delete_list() {
        $redirect_url = $_POST['url'];
        $this->load->model('delete_list_model');
        if($this->delete_list_model->delete_list()) {
			redirect($redirect_url);
		}
		else {
			redirect('site/error_message');
		}
    }

    //Den inloggade användarens profil

    function profile($page=NULL) {
        if($page===NULL){
            $page=0;
        }
        $data['from']=$page;
        $data['older']='profile';    
        $userid = $this->session->userdata('userID');
        $data['title'] = 'Gimme5: Profil';
        $data['menu'] = 'profile';
        $data['empty']='Du har inte skapat några listor än.';
        $this->load->library('upload');
        $data['rubrik']='Mina listor';
        $this->load->model('list_model');

        $data['row'] = $this->list_model->getProfileLists($userid, $page);
        $data['like'] = $this->list_model->getLikes($data);
        $data['comment'] = $this->list_model->getComments($data);
        //hämtar profildata för den inloggade användaren från profileModel
        $this->load->model('profile_model');
        $data['profile'] = $this->profile_model->getProfile($userid);
        if($data['profile'] == FALSE) {
			redirect('site/error_message');
		}
		else {
			$this->load->view('includes/header', $data);
			$this->load->model('create_list_model');
			$data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
			$this->load->view('top_view', $data);
			//ska vara något från profile_model
			//även passa in denna data till profile_view

			$this->load->view('menu/menu_view', $data);
			$this->load->view('profile_view', $data);
			$this->load->view('list_view', $data);
			$this->load->view('includes/footer');
		}
    }

    //hämtar en annan användarens profil

    function user($userID, $page=NULL) {
        if ($page===NULL) {
            $page=0;
        }
        $data['older']='user/'.$userID;
        $data['from']=$page;
        // hämtar userID från adressfältet
        $data['menu'] = 'profile';
        if($page==0){
            $data['empty'] = 'Det finns inga listor för den valda användaren';
        } 
        else{
            $data['empty'] = 'Det finns inga fler listor för den valda användaren';
        }

        $this->load->library('upload');
        $this->load->model('login_model');
        $username = $this->login_model->username($userID);
        $data['title'] = 'Gimme5: ' . $username . 's profil';
        $data['rubrik']=$username.'s listor';
        //hämtar profildata för den inloggade användaren från profileModel
        $this->load->model('profile_model');
        $data['profile'] = $this->profile_model->getProfile($userID);


         $member = $this->session->userdata('is_logged_in');

         if($member){
        //hämtar användarens vänner. Dett behövs för att veta om lägg till som vän eller ta bort vän skall visas i profile_view
        $data['friends'] = $this->profile_model->getFriends($this->session->userdata('userID'));
        }

        //hämtar kommentarer
        $this->load->model('list_model');
        $data['row'] = $this->list_model->getProfileLists($userID, $page);
        $data['like'] = $this->list_model->getLikes($data);
        $data['comment'] = $this->list_model->getComments($data);
        $this->load->view('includes/header', $data);
        $this->load->model('create_list_model');
        $data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
        $this->load->view('top_view', $data);
        //ska vara något från profile_model
        //även passa in denna data till profile_view

        $this->load->view('menu/menu_view', $data);
        $this->load->view('profile_view', $data);
        $this->load->view('list_view', $data);
        $this->load->view('includes/footer');
    }

    function friends() {
		if($this->session->userdata('userID') == NULL) {
			redirect('site/error_message');
		}
		else {
			$data['title'] = 'Gimme5: Vänner';
			$this->load->model('profile_model');
			$data['menu'] = 'friends';
			$data['row'] = $this->profile_model->getFriends($this->session->userdata('userID'));
			

			//hämtar vänförfrågningar
			$data['request'] = $this->profile_model->get_friend_requests($this->session->userdata('userID'));
			$this->load->view('includes/header', $data);
			$this->load->model('create_list_model');
			$data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
			$this->load->view('top_view', $data);
			$this->load->view('menu/menu_view', $data);
			$data['profile_data'] = $this->session->all_userdata();
			$this->load->view('friend_view', $data);
			$this->load->view('includes/footer');
		}
    }

    function create_list() {
		if($this->session->userdata('userID') == NULL) {
			redirect('site/error_message');
		}
		else {
			$data['title'] = 'Gimme5: Create a List';
			$this->load->model('create_list_model');
			$data['menu'] = 'skapa';
			$data['category'] = $this->create_list_model->get_category_dropdown();
			//laddar views
			$this->load->view('includes/header', $data);
			$this->load->model('create_list_model');
			$data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
			$this->load->view('top_view', $data);
			$this->load->view('menu/menu_view', $data);
			$this->load->view('create_list_view', $data);
			$this->load->view('includes/footer');
		}
    }

    function do_upload() {
        $config['upload_path'] = './uploads/user_pics';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = 'true';


        $this->load->library('upload', $config);

        $this->load->model('profile_model');
        $remove_pic=$this->profile_model->remove_pic();

        if (!$this->upload->do_upload()) {
            $this->session->set_flashdata('upload_error', $this->upload->display_errors());
            redirect('site/profile');
        } else {
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();

            $sql = "UPDATE  user SET  user_pic_path = ? WHERE  userID= ? ";

            $this->db->query($sql, array('uploads/user_pics/' . $upload_data['file_name'], $this->session->userdata('userID')));
		$filepath='./uploads/user_pics/'.$upload_data['file_name'];	

			if($sql) {
				if(is_file($filepath))
				{
				    chmod($filepath, 0644);
				}
				redirect('site/profile');
			}
			else {
				redirect('site/error_message');
			}
        }
    }

// för att söka i listor
    function search($search_query=null) {
        $data['from']=FALSE;
        if($search_query){
            $search_string = $search_query;
        }
        else{
            if(isset($_POST['search_field'])){
                $search_string = $_POST['search_field'];
                $this->session->set_userdata('last_search',$search_string);
            }
            elseif ($this->session->userdata('last_search')) {
                $search_string = $this->session->userdata('last_search');
            }
        }
        $data['older']='search';


        /*
        * ladda och använd model
        */
        $this->load->model('search_model');
        $data['rubrik']='Sökresultat';
        $this->load->model('list_model');

        /*
         * DATA
         */
        if(isset($_POST['category'])){
            $data['row'] = $this->search_model->search($search_string, $_POST['category']);
            $this->session->set_userdata('last_category',$_POST['category']);
        }
        elseif ($this->session->userdata('last_category')) {
            $data['row'] = $this->search_model->search($search_string, $this->session->userdata('last_category'));
        }
        else{
            $data['row'] = $this->search_model->search($search_string);
        }
        $data['title'] = 'Gimme5: Search';
        $data['empty'] = 'Sökningen gav tyvärr inga resultat';
        $data['like'] = $this->list_model->getLikes($data);
        $data['comment'] = $this->list_model->getComments($data);

        $member = $this->session->userdata('is_logged_in');
        /*
         * Laddar views
         */
        $this->load->view('includes/header', $data);
        $this->load->model('create_list_model');
        $data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
        $this->load->view('top_view', $data);
        $this->load->view('menu/menu_view');
        //skickar row
		$this->load->view('includes/header', $data);
        if ($data['row']) {
            $this->load->view('list_view', $data);
        } 
        else {
            /*
             * INGA SÖKRESULTAT
             */
            $this->load->view('list_view', $data);
        }
        /*
         * Om inloggad/inte inloggad
         */
        if (!$member) {
            $this->load->view('login_view');
        } else {

            $this->load->model('profile_model');

            //hämtar vänner 
            $friends['friend'] = $this->profile_model->getFriends($this->session->userdata('userID'));

            //hämtar vänförfrågningar
            $friends['request'] = $this->profile_model->get_friend_requests($this->session->userdata('userID'));

            $this->load->view('inloggad_sidebar', $friends);
        }
        $this->load->view('includes/footer');
    }


// för att söka bland användare
    function friend_search($search_query=null) {

       $data['from']=FALSE;
        if($search_query){
            $search_string = $search_query;
        }
        else{
            if(isset($_POST['search_field'])){
                $search_string = html_escape($_POST['search_field']);
            }
            else{
                $search_string = "";
            }
        }

        /*
        * ladda och använd model
        */
        $this->load->model('search_model');
        $this->load->model('profile_model');

        /*
         * DATA
         */
        $data['title'] = 'Gimme5: Användarsökning';
        $data['empty'] = 'Sökningen gav tyvärr inga resultat';
       
        $data['row'] = $this->search_model->friend_search($search_string);
       
      
        /*
         * Laddar views
         */
        $this->load->view('includes/header', $data);
        $this->load->model('create_list_model');
        $data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
        $this->load->view('top_view', $data);
        $this->load->view('menu/menu_view', $data);
        $data['profile_data'] = $this->session->all_userdata();
        $this->load->view('friend_search_view', $data);
        $this->load->view('includes/footer');
    }

    


    function create_comment() {


        $this->load->model('list_model');
        $redirect_url = $_POST['url'];
        $comment['list_id'] = $_REQUEST['list_id'];
        $comment['comment'] = $_REQUEST['comment'];
        if($this->list_model->create_comment($comment)) {
			redirect($redirect_url);
		}
		else {
			redirect('site/error_message');
		}
    }

    function friend_request($userID) {
        $this->load->model('profile_model');
        $insert = $this->profile_model->friend_request($userID);
		if($insert == NULL) {
			redirect('site/error_message');
		}
		else {
			redirect('site/user/' . $userID);
		}
    }

    function error_message() {
        $data['title'] = 'Gimme5: 404';
        $data['menu'] = 'friends';
        $this->load->view('includes/header', $data);
        $this->load->model('create_list_model');
        $data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
        $this->load->view('top_view', $data);
        $this->load->view('menu/menu_view', $data);
        $data['profile_data'] = $this->session->all_userdata();
        $this->load->view('404_view', $data);
        $this->load->view('includes/footer');
        
    }

    // tar bort relationen mellan användaren som skickade vänförfrågning och den inloggade användaren.
    function deny_friend_request($user1, $redirect=NULL){

        $logged_in_user = $this->session->userdata('userID');

        $this->load->model('profile_model');
        $this->profile_model->delete_relation($user1, $logged_in_user);
        if($redirect==NULL){
            redirect('site');
        }
        else{
            redirect('site/friends');
        }
    }

    //anropar accept_friend i profile_model som ändrar is_confimed för relationen till 1 (true)

    function accept_friend_request($user1, $redirect=NULL){

        $logged_in_user = $this->session->userdata('userID');

        $this->load->model('profile_model');
        $this->profile_model->accept_friend($user1, $logged_in_user);
        if($redirect==NULL){
            redirect('site');
        }
        else{
            redirect('site/friends');
        }
    }



    // tar bort relationen mellan användaren och profilsidan som denne befinnner sig på 
    function remove_friend($userID,$redir=NULL){
        $logged_in_user = $this->session->userdata('userID');

        $this->load->model('profile_model');

        // tar bort felation där den angivna användaren är user1 
        $delete=$this->profile_model->delete_relation($userID, $logged_in_user);

         // tar bort felation där den angivna användaren är user2
        if(!$delete){
            $delete=$this->profile_model->delete_relation($logged_in_user, $userID);
        }
        if($redir!==NULL){
            redirect('site/friends');
        }
        else{
            redirect('site/user/' . $userID);
        }
    }


    // returnerar den inloggade användarens vänners alla listor
    function friends_lists($page=NULL){
        if($page===NULL){
            $page=0;
        }
        $data['from']=$page;
	if($page==0){
		$data['empty']='Dina vänner har inga listor';
	}
	else{
		$data['empty']='Dina vänner har inga fler listor';
	}
        $data['older']='friends_lists';
        $logged_in_user = $this->session->userdata('userID');
        $this->load->model('list_model');
        $data['row'] = $this->list_model->get_friends_lists($logged_in_user, $page);
        $data['menu'] = 'startsida';
        $data['tab_page'] = 'friends';
        //för att list_view ska kunna återanvändas för older
        $data['like'] = $this->list_model->getLikes($data);
        $data['comment'] = $this->list_model->getComments($data);
        $data['title'] = 'Gimme5: Vänners listor';

     
        /*
         * Laddar views
         */
        //skickar titel
        $this->load->view('includes/header', $data);
        $this->load->model('create_list_model');
        $data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
        $this->load->view('top_view', $data);

        $this->load->view('menu/menu_view', $data);
        $this->load->view('tab_view');
        //skickar row
        $data['rubrik']='Vänners listor';
        $this->load->view('list_view', $data);
       
        $this->load->model('profile_model');

            //hämtar vänner 
            $friends['friend'] = $this->profile_model->getFriends($this->session->userdata('userID'));

            //hämtar vänförfrågningar
            $friends['request'] = $this->profile_model->get_friend_requests($this->session->userdata('userID'));

            $this->load->view('inloggad_sidebar', $friends);
                  
        $this->load->view('includes/footer');
    }

    function most_popular($page=NULL){
        if($page===NULL){
            $page=0;
            $data['page']=$page;
        }
        $data['from']=$page;
        $data['empty']='Det finns inga fler populära listor';
        $data['older']='most_popular';
        $data['menu'] = 'Mest populära';
        $data['tab_page'] = 'most_popular';
        $this->load->model('list_model');
        $data['row'] = $this->list_model->get_most_popular($page);
        //för att list_view ska kunna återanvändas för older
        $data['like'] = $this->list_model->getLikes($data);
        $data['comment'] = $this->list_model->getComments($data);
        $data['title'] = 'Gimme5: Mest populära listor';

     
        /*
         * Laddar views
         */
        //skickar titel
        $this->load->view('includes/header', $data);
        $this->load->model('create_list_model');
        $data['category_dropdown'] = $this->create_list_model->get_category_dropdown();
        $this->load->view('top_view', $data);

        $this->load->view('menu/menu_view', $data);
        $this->load->view('tab_view');
        //skickar row
        $data['rubrik']='Mest populära';
        $this->load->view('list_view', $data);
       
        $this->load->model('profile_model');

            //hämtar vänner 
            $friends['friend'] = $this->profile_model->getFriends($this->session->userdata('userID'));

            //hämtar vänförfrågningar
            $friends['request'] = $this->profile_model->get_friend_requests($this->session->userdata('userID'));

            $this->load->view('inloggad_sidebar', $friends);
                  
        $this->load->view('includes/footer');
    }

    function like_toggle($listID, $url=NULL){
	
        if(isset($_GET['url'])){
            $redirect_url = $_GET['url'];
        }
        $logged_in_user= $this->session->userdata('userID');
        $this->load->model('list_model');
        $this->list_model->like_toggle($listID, $logged_in_user);
        redirect($redirect_url);
    }

}
?>
