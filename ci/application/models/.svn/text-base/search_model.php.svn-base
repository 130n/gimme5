<?php
class Search_model extends CI_Model {

    function test_search($test_string){
      preg_match_all('/([a-zA-Z0-9åäöÅÄÖ]+)|(?:"([a-zA-Z0-9åäöÅÄÖ ]+)")/i', $test_string, $result);
      $result = array_merge($result[1], $result[2]);
      $result=array_filter($result);
      return $result;
    }

    function search($str_arr, $category=NULL) {
      /*
       * Splittar strängen med regexp.
       * mergar arrayerna som skapas
       * filtrerar bort tomma strängar
       */
      $sql_IN_strings = " ";
      if($category){
        $cat= " AND list.category = '".$category."' ";
      }
      else{
        $cat=" ";
      }
      if($str_arr=='Search' || $str_arr=='Sök...'){
        $sql_IN_strings = " ";
      }
      else{
        preg_match_all('/([a-zA-Z0-9åäöÅÄÖ\.\,\-]+)|(?:"([a-zA-Z0-9åäöÅÄÖ\.\,\- ]+)")/i', $str_arr, $result);
        $result = array_merge($result[1], $result[2]);
        $result=array_filter($result);
  /*
  * undefined offset 0?
  */
        if(count($result)>0){
          $sql_IN_strings=" AND listtag.tag IN (";
          $first=TRUE;
          foreach ($result as $term) {

              if($first){
                $sql_IN_strings.= "'".$term."'";
                $first=FALSE;
              }
              else{
                $sql_IN_strings.= ", '".$term."'";
              }
          }
          $sql_IN_strings .= ") ";
        }
      }
        // return $str;
        $q = $this->db->query(
            "SELECT time, title, creator, userName, listID, userID, user_pic_path, category,
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
            FROM listpost AS t1, list, user, description, listtag
            WHERE t1.list=list.listid
            AND user.userID=list.creator"
      .$cat."
      AND list.listid = listtag.list
      ".$sql_IN_strings."
      GROUP BY time 
      ORDER BY time desc");
        
                if ($q->num_rows() > 0) {
          foreach ($q->result() as $row) {
            $data[] = $row;
          }
          return $data;
        } 
        else
        {
          return FALSE;
        }
    }


    function friend_search($str_arr) {
        /*
        * Splittar strängen med regexp.
        * mergar arrayerna som skapas
        * filtrerar bort tomma strängar
        */

        if($str_arr=='Sök efter vänner' || $str_arr==''){
            return FALSE;
        }
        else{
            preg_match_all('/([a-zA-Z0-9åäöÅÄÖ\.\,\-]+)|(?:"([a-zA-Z0-9åäöÅÄÖ\.\,\- ]+)")/i', $str_arr, $result);
            $result = array_merge($result[1], $result[2]);
            $result=array_filter($result);
/*
* BYGGER STRÄNG SOM SKA KONKATENERAS I SQL
*/
            if(count($result)>0){
                $sql_IN_strings ="WHERE username ";
                if(is_array($result)){
                  $first=TRUE;
                  $sql_IN_strings .= "IN (";
                  foreach ($result as $term) {
                      if($first){
                        $first=FALSE;
                        $sql_IN_strings.= "'".$term."'";
                      }
                      else{
                        $sql_IN_strings.=", '".$term."'";
                      }
                  }
                  $sql_IN_strings.=")";
                }
                else{
                  $sql_IN_strings.= "= '".$result."'";
                }
            }
            else{
                $sql_IN_strings = " ";
            }
            // return $str;
            $q = $this->db->query(
            "SELECT * 
            FROM user
            WHERE username IN (
            SELECT username 
            FROM  user
            ".$sql_IN_strings." )
            LIMIT 0, 12"
            );
        }


            if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
            $data[] = $row;
            }
            return $data;
            } 
            else
            {
            return FALSE;
            }
        }



}