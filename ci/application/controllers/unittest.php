<?php

Class Unittest extends CI_Controller {

// Kör alla tester

    function index() {// Kör alla metoder med tester
        $this->login_model_test(); // Testar samt loggar också in som: test
        $this->create_list_model_test();  // Kan inte köras först för anvönder sig av inloggad data
        $this->list_model_test();
        $this->profile_model_test();
        $this->logout(); // loggar ut som: test
        $this->report_test_data();// Rapporterar (skriver ut) alla testers testdata.
    }

    function create_list_model_test() {
        // Ladda in modellen
        $this->load->model('create_list_model');

        // Posta testdata
        $_POST['title'] = 'testlista1';
        $_POST['creator'] = '6'; // onödigt? Anvönder sig öndå av den inloggade perssonen
        $_POST['category'] = 'Fordon';
        $_POST['post1'] = '1';
        $_POST['post2'] = '2';
        $_POST['post3'] = '3';
        $_POST['post4'] = '4';
        $_POST['post5'] = '5';

        // Kör funktionen med testdata
        $data = $this->create_list_model->create_list();

        // Testa om det skapats en lista
        $test = $data;
        $expected_result = 'is_true';
        $test_name = 'create_list_model_test';
        $this->unit->run($test, $expected_result, $test_name, 'Testa att skapa en lista');

        // Ta bort listan som just skapades (alla listor av anvöndaren 'test', userID '6'.
        $data2 = '6';
        $list = $this->db->query(
                'SELECT * 
			FROM `list` 
			WHERE creator=' . $data2 . ';');
        $row = $list->row_array();
        $creator = $row['creator'];

        if ($creator == '6') {
            $q = $this->db->query(
                    'DELETE FROM list 
				WHERE creator=' . $data2 . ';');
        }

        // Testfall för ifall listan kunde tas bort
        $test = $q;
        $expected_result = 'is_true';
        $test_name = 'create_list_model_test_delete';
        $this->unit->run($test, $expected_result, $test_name, 'Ta bort den skapade listan');
    }

    function login_model_test() {
        //Ladda in modellen
        $this->load->model('login_model');


        // testa att skapa en anvöndare
        $_POST['username'] = 'test_new';
        $_POST['pwd'] = 'test_new';
        $_POST['mail'] = 'test_new@test_new.com';
        $data = $this->login_model->create_account();
        $test = $data;
        $expected_result = 'is_true'; // förvöntas bli sant, då har kontot skapats
        $test_name = 'login_model_create_account';
        $this->unit->run($test, $expected_result, $test_name, 'test create account, test_new');



        // testa att ta bort anvöndaren
        $username = $this->login_model->delete_account();
        $test = $username;
        $expected_result = 'is_true';
        $test_name = 'login_model_test_delete_account';
        $this->unit->run($test, $expected_result, $test_name, 'test delete account');


        // testa att logga in med korrekt username och password
        $_POST['login_username'] = 'test';
        $_POST['login_pwd'] = 'test';
        $userID = $this->login_model->validate();
        $test = $userID;
        $expected_result = '6';  // förvöntas få userID för anvöndaren test vilket ör 6.
        $test_name = 'login_model_test_userID_success';
        $this->unit->run($test, $expected_result, $test_name, 'test login with correct username and password');

        // testa att logga in med felaktigt username och password
        $_POST['login_username'] = 'test';
        $_POST['login_pwd'] = 'badpassword';
        $userID = $this->login_model->validate();
        $test = $userID;
        $expected_result = 'is_false';  //förvöntas bli falskt, alltså ej kunna logga in
        $test_name = 'login_model_test_userID_fail';
        $this->unit->run($test, $expected_result, $test_name, 'test login with correct username and bad password');
    }

    function list_model_test() {
        //Ladda in modellen
        $this->load->model('list_model');
        //Hömta data
        $data['row'] = $this->list_model->getAll();
        // Loop som går igenom och testar all data som hömtas av funktionen getAll
        foreach ($data['row'] as $r):

            //tests if there is a creator (and its a string), cant be null
            $test = (int) $r->creator;
            $expected_result = 'is_int';
            $test_name = 'list_model_test_creator';
            $this->unit->run($test, $expected_result, $test_name, 'tests if there is a creator (and its an int), cant be null');

            //tests all listID
            $test = (int) $r->listID;
            $expected_result = 'is_int';
            $test_name = 'list_model_test_listID';
            $this->unit->run($test, $expected_result, $test_name, 'cant be null');

            //tests all listID
            $test = $r->userName;
            $expected_result = 'is_string';
            $test_name = 'list_model_test_userName';
            $this->unit->run($test, $expected_result, $test_name, 'cant be null');

            //test all titles
            $test = $r->title;
            $expected_result = 'is_string';
            $test_name = 'list_model_test_title';
            $this->unit->run($test, $expected_result, $test_name);

            //test all descriptions, allowed to be null
            $test = $r->de1;
            if ($test == null) {/* do nothing */
            } else {
                $expected_result = 'is_string';
                $test_name = 'list_model_test_descriptions';
                $this->unit->run($test, $expected_result, $test_name);
            }//test all descriptions, allowed to be null
            $test = $r->de2;
            if ($test == null) {/* do nothing */
            } else {
                $expected_result = 'is_string';
                $test_name = 'list_model_test_descriptions';
                $this->unit->run($test, $expected_result, $test_name);
            }//test all descriptions, allowed to be null
            $test = $r->de3;
            if ($test == null) {/* do nothing */
            } else {
                $expected_result = 'is_string';
                $test_name = 'list_model_test_descriptions';
                $this->unit->run($test, $expected_result, $test_name);
            }//test all descriptions, allowed to be null
            $test = $r->de4;
            if ($test == null) {/* do nothing */
            } else {
                $expected_result = 'is_string';
                $test_name = 'list_model_test_descriptions';
                $this->unit->run($test, $expected_result, $test_name);
            }

            //test all descriptions, allowed to be null
            $test = $r->de5;
            if ($test == null) {/* do nothing */
            } else {
                $expected_result = 'is_string';
                $test_name = 'list_model_test_descriptions';
                $this->unit->run($test, $expected_result, $test_name);
            }

            //test all posts, not allowed to be null
            $test = $r->p1;
            $expected_result = 'is_string';
            $test_name = 'list_model_test_post';
            $this->unit->run($test, $expected_result, $test_name);

            //test all posts, not allowed to be null
            $test = $r->p2;
            $expected_result = 'is_string';
            $test_name = 'list_model_test_post';
            $this->unit->run($test, $expected_result, $test_name);

            //test all posts, not allowed to be null
            $test = $r->p3;
            $expected_result = 'is_string';
            $test_name = 'list_model_test_post';
            $this->unit->run($test, $expected_result, $test_name);

            //test all posts, not allowed to be null
            $test = $r->p4;
            $expected_result = 'is_string';
            $test_name = 'list_model_test_post';
            $this->unit->run($test, $expected_result, $test_name);

            //test all posts, not allowed to be null
            $test = $r->p5;
            $expected_result = 'is_string';
            $test_name = 'list_model_test_post';
            $this->unit->run($test, $expected_result, $test_name);

        endforeach;
    }


    function profile_model_test() {

        //Ladda in modellen
        $this->load->model('profile_model');

        /**
        * Test av getProfile
        *
        */
        

        //testa getProfile med ett anvöndarkonto som finns, och inte har några listor
        $test = $this->profile_model->getProfile(6);
        $expected_result = 'is_array';
        $test_name = 'profile_model_test_getProfile_existing_profile_without_lists';
        $this->unit->run($test, $expected_result, $test_name);

        //testa getProfile med ett anvöndarkonto som finns, som har listor
        $test = $this->profile_model->getProfile(1);
        $expected_result = 'is_array';
        $test_name = 'profile_model_test_getProfile_existing_profile_with_lists';
        $this->unit->run($test, $expected_result, $test_name);


        //testar getProfile med ett anv?ndarkonto som inte finns
        $test = $this->profile_model->getProfile(-1);
        $expected_result = false;
        $test_name = 'profile_model_test_getProfile_not_existing_profile';
        $this->unit->run($test, $expected_result, $test_name);

        
        //testar getProfile med ett med specialtecken som inmatning
        $test = $this->profile_model->getProfile('*)¤/&"%¤";');
        $expected_result = false;
        $test_name = 'profile_model_test_getProfile_special_characters';
        $this->unit->run($test, $expected_result, $test_name);


        /**
        * Test av getFriends
        *
        */


        //testa getFriends med ett anvöndarkonto som finns, och inte har några listor
        $test = $this->profile_model->getFriends(6);
        $expected_result = true;
        $test_name = 'profile_model_test_getFriends_existing_profile_without_lists';
        $this->unit->run($test, $expected_result, $test_name);


         //testa getFriends med ett anvöndarkonto som finns, som har några listor
        $test = $this->profile_model->getFriends(1);
        $expected_result = 'is_array';
        $test_name = 'profile_model_test_getFriends_existing_profile_with_lists';
        $this->unit->run($test, $expected_result, $test_name);


        //testa getProfile med ett anvöndarkonto som inte finns
        $test = $this->profile_model->getFriends(-1);
        $expected_result = false;
        $test_name = 'profile_model_test_getFriends_not_existing_profile';
        $this->unit->run($test, $expected_result, $test_name);

        //testar getProfile med ett med specialtecken som inmatning
        $test = $this->profile_model->getFriends('*)¤/&"%¤";');
        $expected_result = false;
        $test_name = 'profile_mode l_test_getFriends_special_characters';
        $this->unit->run($test, $expected_result, $test_name);


        /**
        * Test av get_friend_requests
        *
        */

        //testar get_friend_requests med ett anv?ndarkonto som finns, och inte har n?gra f?rfr?gningar 
        $test = $this->profile_model->get_friend_requests(6);
        $expected_result = TRUE;
        $test_name = 'profile_model_test_get_friend_requests_existing_profile_without_lists';
        $this->unit->run($test, $expected_result, $test_name);

         //testar get_friend_requests med ett anv?ndarkonto som finns, och har en obesvarad f?rfr?gningar 
        $test = $this->profile_model->get_friend_requests(15);
        $expected_result = true;
        $test_name = 'profile_model_test_get_friend_requests_existing_profile_without_lists';
        $this->unit->run($test, $expected_result, $test_name);

         //testa get_friend_requests med ett anvöndarkonto som inte finns
        $test = $this->profile_model->get_friend_requests(-1);
        $expected_result = false;
        $test_name = 'profile_model_test_get_friend_requests_requests_not_existing_profile';
        $this->unit->run($test, $expected_result, $test_name);

        //testar getProfile med ett med specialtecken som inmatning
        $test = $this->profile_model->getFriends('*)¤/&"%¤";');
        $expected_result = false;
        $test_name = 'profile_model_test_get_friend_requests_special_characters';
        $this->unit->run($test, $expected_result, $test_name);


         /**
        * Test av friend_request
        *
        */
        
        //testar friend_request mellan den test, som ?r  den inloggade anv?ndaren under testet och en 
        // anv?ndare som inte har n?gra f?rfr?gningar 
        $test = $this->profile_model->friend_request(20);
        $expected_result = TRUE;
        $test_name = 'profile_model_test_get_friend_requests_existing_profile_without_friend_requests';
        $this->unit->run($test, $expected_result, $test_name);

         //testar friend_request med ett anv?ndarkonto som finns, och har en obesvarad f?rfr?gningar 
        $test = $this->profile_model->friend_request(15);
        $expected_result = TRUE;
        $test_name = 'profile_model_test_get_friend_requests_existing_profile_with_friend_requests';
        $this->unit->run($test, $expected_result, $test_name);

        //testar friend_request med ett anv?ndarkonto som finns, och har en obesvarad f?rfr?gningar fr?n den inloggade anv?ndaren 
        $test = $this->profile_model->friend_request(15);
        $expected_result = FALSE;
        $test_name = 'profile_model_test_get_friend_requests_existing_profile_friend_requests_from_logged_in_user';
        $this->unit->run($test, $expected_result, $test_name);

        //testa friend_request med ett anv?ndarkonto som inte finns
        $test = $this->profile_model->friend_request(-1);
        $expected_result = FALSE;
        $test_name = 'profile_model_test_get_friend_requests_requests_not_existing_profile';
        $this->unit->run($test, $expected_result, $test_name);

   
        //testar getProfile med ett med specialtecken som inmatning
        $test = $this->profile_model->getFriends('*)¤/&"%¤";');
        $expected_result = FALSE;
        $test_name = 'profile_model_test_get_friend_requests_special_characters';
        $this->unit->run($test, $expected_result, $test_name);

        //?test?ller status genom att ta bort de skapade relationerna
        $this->profile_model->delete_relation('6', '20');
        $this->profile_model->delete_relation('6', '15');

         /**
        * Test av accept_relation
        *
        */

        //testar accept_friend n?r den inloggade anv?ndaren inte har n?gra f?rfr?gningar 
        $test = $this->profile_model->accept_friend(6, 15);
        $expected_result = FALSE;
        $test_name = 'profile_model_test_accept_relation_existing_profile_without_friend_request';
        $this->unit->run($test, $expected_result, $test_name);
        

                $q = "INSERT INTO `relation` (`user1`, `user2`, `is_confirmed`) VALUES (?, ?,'0')";

                    $this->db->query($q, array('15', '6'));
                    

        //testar accept_friend mellan den inloggade anv?ndaren och en anv?ndare som har skickat f?rfr?gan 
        $test = $this->profile_model->accept_friend(15, 6);
        $expected_result = TRUE;
        $test_name = 'profile_model_test_accept_relation_existing_profile_with_friend_request';
        $this->unit->run($test, $expected_result, $test_name);


        // tar bort relationen skapad under testet
        $this->profile_model->delete_relation('15', '6');


       //testar accept_friend mellan den inloggade anv?ndaren och en som inte finns 
        $test = $this->profile_model->accept_friend(-1, 6);
        $expected_result = FALSE;
        $test_name = 'profile_model_test_accept_relation_non_existing_profile';
        $this->unit->run($test, $expected_result, $test_name);

        //testar accept_friend mellan den inloggade anv?ndaren och ett med specialtecken som inmatning
        $test = $this->profile_model->accept_friend('e', 6);
        $expected_result = FALSE;
        $test_name = 'profile_model_test_accept_relation_special_characters';
        $this->unit->run($test, $expected_result, $test_name);

    }

    function logout() {
        $this->session->sess_destroy();
    }

    function report_test_data() {
        echo $this->unit->report();
    }

}

?>
