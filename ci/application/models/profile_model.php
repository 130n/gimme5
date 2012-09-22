<?php

class Profile_model extends CI_Model {

    //returnerar proildata från en angiven användare som $data 
    function getProfile($userID) {

        if(is_numeric($userID)){

            $q = $this->db->query(
                'SELECT  * 
    			FROM user
    			WHERE userID=' . $userID . ';');

            if ($q->num_rows() > 0) {
                foreach ($q->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }

    // hämtar alla vänner för en angiven användare

    function getFriends($userID) {

        if(is_numeric($userID)){
            $q = $this->db->query('
    			(SELECT *
                FROM relation, user
                WHERE relation.user1=user.userID
                AND user2 =  '.$userID.')

                UNION 

                (SELECT *
                FROM relation, user
                WHERE relation.user2=user.userID
                AND user1 =  '.$userID.'
                )'
                );

            if ($q->num_rows() > 0) {
                foreach ($q->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return FALSE;
            }
        }
        else {
            return FALSE;
        }
    }


// hämtar en användares vänförfrågningar

    function get_friend_requests($userID){

        if ($userID){
            $q = $this->db->query('
                SELECT *
                FROM relation, user
                WHERE relation.user1=user.userID
                AND user2 =  '. $userID . '
                AND relation.is_confirmed="0"'

                );

            if ($q->num_rows() > 0) {
                foreach ($q->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            } else {
                return FALSE;
            }
        }
        else 
       return FALSE;

    }





    // funktion som skapar en relation mellan user1 (den inloggade användaren) och user2 (profilsidan användaren befann sig på när hon tryckte på lägg till som vän)

    function friend_request($userID) {

        $logged_in_user = $this->session->userdata('userID');

        // kollar så att userID är en siffra
        if(is_numeric($userID)){

            // kollar att userID tillhör en riktig användare 
            $real_user=$this->db->query(
                'SELECT * 
                FROM user
                WHERE userID='.$userID);

            if ($real_user->num_rows() == 1){

                $existing_relation = $this->db->query(
                    'SELECT * 
        			FROM relation
        			WHERE user1=' . $userID . '
        			AND user2= ' . $logged_in_user . '
        			OR user1 =  ' . $logged_in_user . '
        			AND user2 =  ' . $userID);

                if ($existing_relation->num_rows() > 0) {

                    // relation finns redan. 
                    return false;
                } 
                else {

                    // relation finns inte tidigare. får skapa!

                    $q = "INSERT INTO `relation` (`user1`, `user2`, `is_confirmed`) VALUES (?, ?,'0')";

                    $insert=$this->db->query($q, array($logged_in_user, $userID));

                    return $insert;
                }
            }
        }
    }


       
  // kollar om det finns en relation att ta bort och tar bort om det finns

    function delete_relation($user1, $user2){

        // kollar att det finns en relation att ta bort
         $existing_relation = $this->db->query('
            SELECT *
            FROM relation
            WHERE user1 ='.$user1.' 
            AND user2='.$user2);

    
         // tar bort om så är fallet
         if ($existing_relation->num_rows() > 0) {

            $delete_relation = $this->db->query('

            DELETE FROM relation 
            WHERE user1='.$user1.' 
            AND user2 ='.$user2);

             return $delete_relation;
        }

        else return false;

    }

    // Kollar om det finns en relation och ändrar is_confimed för relationen till 1 (true)

    function accept_friend($user1, $user2){

         // kollar så att userID är en siffra
        if(is_numeric($user1) && is_numeric($user2)){

            // kollar att det finns en relation att acceptera 
             $existing_relation = $this->db->query('
                SELECT *
                FROM relation
                WHERE user1 ='.$user1.' 
                AND user2='.$user2);

        
             // acceptera om så är fallet
             if ($existing_relation->num_rows() > 0) {

                $accept_relation = $this->db->query('

                UPDATE  relation 
                SET  is_confirmed =  1 
                WHERE user1 ='.$user1.' 
                AND user2='.$user2);


                return $accept_relation;

            }

          

        }
        return false;
    }


    // Tar bort den inloggade användarens bild

    function remove_pic(){


        $logged_in_user = $this->session->userdata('userID');

        //hämta sökväg till bild som skall tas bort

        $old_pic= $this->db->query('
        SELECT user_pic_path
        FROM user
        WHERE userID='. $logged_in_user);
 

        if ($old_pic->num_rows() > 0) {
                foreach ($old_pic->result() as $row) {
                    $data[] = $row->user_pic_path;
                }

            // kolla så att det verkligen är en fil 
            if(is_file($data[0]) && $data[0]!='uploads/user_pics/user_img.png'){

                // tar bort bilden
                if (unlink($data[0])){

                   // referera till standardbilden
                    $change_pic_path=$this->db->query("
                    UPDATE  `user` 
                    SET  `user_pic_path` =  'uploads/user_pics/user_img.png' 
                    WHERE  `user`.`userID` =".$logged_in_user);

                    return true;

                }
            } 
        }          

        // bilden ej borttagen
        return false; 
}


} //profile_model
 
?>