<?php

class List_model extends CI_Model {

//h?mtar tid, titel, skaparens id, skaparens namn, listans och alla poster. En lista per rad. 
    function getAll() {

        /*
         * för alla
         * rad: time, title, creator, userName, listID, p1, p2, p3, p4, p5, de1, de2, de3, de4, de5
         * ordning: tid, nyast först
         * antal: ?
         */
        $q = $this->db->query(
                "SELECT  time, title, creator, userName, listID, userID, user_pic_path, category,
		    (SELECT post FROM listpost WHERE rank='1' AND list = t1.list) AS p1,
		    (SELECT post FROM listpost WHERE rank='2' AND list = t1.list) AS p2, 
		    (SELECT post FROM listpost WHERE rank='3' AND list = t1.list) AS p3,
		    (SELECT post FROM listpost WHERE rank='4' AND list = t1.list) AS p4,
		    (SELECT post FROM listpost WHERE rank='5' AND list = t1.list) AS p5,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='1' AND list = t1.list) ) AS de1,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='2' AND list = t1.list) ) AS de2,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='3' AND list = t1.list) ) AS de3,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='4' AND list = t1.list) ) AS de4,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='5' AND list = t1.list) ) AS de5
			FROM listpost AS t1, list, user, description
			WHERE t1.list=list.listid
			AND user.userID=list.creator
			GROUP BY time
			ORDER BY time desc
            LIMIT 0, 10;"
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

function getOlder($page) {

        /*
         * för alla
         * rad: time, title, creator, userName, listID, p1, p2, p3, p4, p5, de1, de2, de3, de4, de5
         * ordning: tid, nyast först
         * antal: ?
         */
        $start = ($page*10);
        $stop = $start+10;
        $q = $this->db->query(
                "SELECT  time, title, creator, userName, listID, userID, user_pic_path, category,
            (SELECT post FROM listpost WHERE rank='1' AND list = t1.list) AS p1,
            (SELECT post FROM listpost WHERE rank='2' AND list = t1.list) AS p2, 
            (SELECT post FROM listpost WHERE rank='3' AND list = t1.list) AS p3,
            (SELECT post FROM listpost WHERE rank='4' AND list = t1.list) AS p4,
            (SELECT post FROM listpost WHERE rank='5' AND list = t1.list) AS p5,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='1' AND list = t1.list) ) AS de1,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='2' AND list = t1.list) ) AS de2,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='3' AND list = t1.list) ) AS de3,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='4' AND list = t1.list) ) AS de4,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='5' AND list = t1.list) ) AS de5
            FROM listpost AS t1, list, user, description
            WHERE t1.list=list.listid
            AND user.userID=list.creator
            GROUP BY time
            ORDER BY time desc
            LIMIT ".$start.",".$stop." ;"

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

    // Returnerar en användares listor

    function getProfileLists($userid, $page=NULL) {

        /*
         * för en vald användare
         * rad: time, title, creator, userName, listID, p1, p2, p3, p4, p5, de1, de2, de3, de4, de5
         * ordning: tid, nyast först
         * antal: ?
         */
            $start = $page*10;
            $stop = $start+10;

            if(is_numeric($userid)){
            $q = $this->db->query(
                    "SELECT  time, title, creator, userName, listID, userID, user_pic_path, category,
    		    (SELECT post FROM listpost WHERE rank='1' AND list = t1.list) AS p1,
    		    (SELECT post FROM listpost WHERE rank='2' AND list = t1.list) AS p2, 
    		    (SELECT post FROM listpost WHERE rank='3' AND list = t1.list) AS p3,
    		    (SELECT post FROM listpost WHERE rank='4' AND list = t1.list) AS p4,
    		    (SELECT post FROM listpost WHERE rank='5' AND list = t1.list) AS p5,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='1' AND list = t1.list) ) AS de1,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='2' AND list = t1.list) ) AS de2,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='3' AND list = t1.list) ) AS de3,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='4' AND list = t1.list) ) AS de4,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='5' AND list = t1.list) ) AS de5
    			FROM listpost AS t1, list, user, description
    			WHERE t1.list=list.listid
    			AND user.userID=list.creator
    			AND user.userID=" . $userid .
                    " GROUP BY time 
    			ORDER BY time desc
                LIMIT ".$start.",".$stop." ;");

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

    function get_friends_lists($userid, $page) {

        /*
         * hämtar en vald användares vänners listor
         * rad: time, title, creator, userName, listID, p1, p2, p3, p4, p5, de1, de2, de3, de4, de5
         * ordning: tid, nyast först
         * antal: ?
         */   
        $start=$page*10;
        $stop=$start+10;

        if(is_numeric($userid)){
            $q = $this->db->query(
                "SELECT  time, title, creator, userName, listID, userID, user_pic_path, category,
                (SELECT post FROM listpost WHERE rank='1' AND list = t1.list) AS p1,
                (SELECT post FROM listpost WHERE rank='2' AND list = t1.list) AS p2, 
                (SELECT post FROM listpost WHERE rank='3' AND list = t1.list) AS p3,
                (SELECT post FROM listpost WHERE rank='4' AND list = t1.list) AS p4,
                (SELECT post FROM listpost WHERE rank='5' AND list = t1.list) AS p5,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='1' AND list = t1.list) ) AS de1,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='2' AND list = t1.list) ) AS de2,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='3' AND list = t1.list) ) AS de3,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='4' AND list = t1.list) ) AS de4,
                        (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='5' AND list = t1.list) ) AS de5
                FROM listpost AS t1, list, user, description
                WHERE t1.list=list.listid
                AND user.userID=list.creator
                AND (user.userID IN 
                        (SELECT user1
                        FROM relation
                        WHERE user2 =  ".$userid.")
                OR  user.userID IN 
                        (SELECT user2
                        FROM relation
                        WHERE  user1 =  ".$userid.")
                    )
                GROUP BY time 
                ORDER BY time desc
                LIMIT ".$start.", ".$stop.";"
                );

            if ($q->num_rows() > 0) {
                foreach ($q->result() as $row) {
                    $data[] = $row;
                    }
                    return $data;
            } 
        }
      
        return FALSE;
    }


    function getLikes($data){
        $row = $data['row'];
         if ($row) {
            /*
             * sätts till null för att kunna kolla om det finns likes. 
             * Går inte att köra if(!$likes) annars.
             */
            $likes = null;
            foreach ($row as $r) :
                $q = $this->db->query('
                    SELECT listID, COUNT(DISTINCT user) as likes
                    FROM list, vote
                    where list.listid=vote.list
                    AND list.listid=' . $r->listID . '
                    Group by listID');



                         
                if ($q->num_rows() > 0) {
                    foreach ($q->result() as $row) {

                        $likes[] = $row;
                    }
                }

            endforeach;
            return $likes;
        }
        else
            return FALSE;
    }


   

    /*
     * Returnerar de kommentarer som finns för listorna som skickas med som argument
     */

    function getComments($data) {
        $row = $data['row'];
        if ($row) {
            /*
             * sätts till null för att kunna kolla om det finns kommentarer. 
             * Går inte att köra if(!$comments) annars.
             */
            $comments = null;
            foreach ($row as $r) :
                $q = $this->db->query('
							SELECT * 
							FROM comment, user
							WHERE comment.user=user.userID
							AND comment.list=' . $r->listID . '
							ORDER BY time asc;');

                if ($q->num_rows() > 0) {
                    foreach ($q->result() as $row) {

                        $comments[] = $row;
                    }
                }

            endforeach;
            return $comments;
        }
        else
            return FALSE;
    }

// lägger in kommentar i databasen. 
    function create_comment($comment) {

        $comment = html_escape($_REQUEST['comment']);
        $list_id = $_REQUEST['list_id'];
        $userID = $this->session->userdata('userID');

        $q = 'INSERT INTO `' . $this->db->database . '`.`comment` 
							(`commentID`, `text`, `time`, `user`, `list`) 
							VALUES (NULL, ?, CURRENT_TIMESTAMP, ?, ?)';

        $comment = $this->db->query($q, array($comment, $userID, $list_id));

        return $q;
    }



    // Skapar rad i vote om ingen röst finns tidigare, annars tas den bort. 
    function like_toggle($listID, $logged_in_user){

        // kollar så att listID och userID är numeriska
        if(is_numeric($listID) && is_numeric($logged_in_user) ){

            $q = $this->db->query('
            SELECT *
            FROM vote, list
            WHERE vote.list = list.listID
            AND list='.$listID.'
            AND user='.$logged_in_user);

            // det finns en tidigare röst som vi skall ta bort
            if ($q->num_rows() != 0) {
                
                $delete=$this->db->query('
                    DELETE FROM `vote` 
                    WHERE `vote`.`list` = '.$listID.' 
                    AND `vote`.`user` = '.$logged_in_user                   
                );

               return true;
            }


            // det finns ingen tidigare röst, vi får skapa!
            else{

                $creator = $this->db->query('
                SELECT *
                FROM list
                WHERE creator='.$logged_in_user.'
                AND listID='.$listID);


                // det är inte samma användare som skapat listan som försöker gilla den
                if ($creator->num_rows() == 0) {
                
                $insert=$this->db->query('
                    INSERT INTO `vote` (`list` , `user` ,`positive`)
                    VALUES ('.$listID.',  '.$logged_in_user.',  "1");');

                    return $insert;
                }
  
            }   
        }
        else return FALSE;
    }
    function get_most_popular($page) {
        $start=$page*10;
        $stop=$start+10;

        $q = $this->db->query(
            "SELECT  time, title, creator, userName, listID, userID, user_pic_path, category,
            COUNT(vote.user) as likes,
            (SELECT post FROM listpost WHERE rank='1' AND list = t1.list) AS p1,
            (SELECT post FROM listpost WHERE rank='2' AND list = t1.list) AS p2, 
            (SELECT post FROM listpost WHERE rank='3' AND list = t1.list) AS p3,
            (SELECT post FROM listpost WHERE rank='4' AND list = t1.list) AS p4,
            (SELECT post FROM listpost WHERE rank='5' AND list = t1.list) AS p5,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='1' AND list = t1.list) ) AS de1,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='2' AND list = t1.list) ) AS de2,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='3' AND list = t1.list) ) AS de3,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='4' AND list = t1.list) ) AS de4,
                    (SELECT description FROM description WHERE descriptionID = (SELECT description FROM listpost WHERE rank='5' AND list = t1.list) ) AS de5
            FROM listpost AS t1, user, description, list
            LEFT JOIN vote ON vote.list = listID
            WHERE t1.list=list.listid
            AND user.userID=list.creator
            GROUP BY time
            ORDER BY likes desc
            LIMIT ".$start.", ".$stop.";"
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
}
?>