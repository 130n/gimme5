<?php

class Statistics_model extends CI_Model {

    /*
     * Ger antal besökare per dag, totalt antal och unika
     * Visas i den övre grafen
     * kolumner: date    year    month   day visitors   u_visitors
     */
    function visitors() {
        $q = $this->db->query(
                "SELECT visit_time as date, 
                    YEAR(visit_time) as year, 
                    MONTH(visit_time) as month, 
                    DAY(visit_time) as day,
                COUNT(*) as visitors, 
                COUNT(DISTINCT ip) as u_visitors
                FROM visit
                GROUP BY DATE(visit_time);"
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

/*
     * Ger antal skapade listor och användarkonton per dag
     * Visas i den undre grafen
     * kolumner: date    year    month   day lists   users
     */
function created_lists_and_users() {
        $q = $this->db->query(
                "SELECT 
                DATE(time) as date, 
                YEAR(time) as year, 
                MONTH(time) as month, 
                DAY(time) as day,
                COUNT(listid) as lists, 
                COUNT(user.userid) as users
                FROM list as l1
                LEFT JOIN user ON DATE(user.date_of_creation) = DATE(l1.time)
                GROUP BY DATE(time);"
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


    function created_lists() {
        $q = $this->db->query(
                "SELECT DATE(time) as date, 
				COUNT(*) as lists
				FROM list
				GROUP BY date;"
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

    function registered_users() {
        $q = $this->db->query(
                "SELECT DATE(date_of_creation) as date, 
				COUNT(*) as registrations
				FROM user
				GROUP BY date;"
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

    function month_visitors(){
    $q = $this->db->query('
    SELECT visit_time AS DATE, YEAR( visit_time ) AS YEAR, MONTH( visit_time ) AS 
    MONTH , DAY( visit_time ) AS 
    DAY , COUNT( * ) AS visitors, COUNT( DISTINCT ip ) AS u_visitors
    FROM visit
    WHERE MONTH( visit_time ) = MONTH( NOW( ) ) 
    GROUP BY MONTH( visit_time )'


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


    function week_visitors(){
    $q = $this->db->query('
    SELECT visit_time AS DATE, YEAR( visit_time ) AS YEAR, MONTH( visit_time ) AS 
    MONTH , DAY( visit_time ) AS 
    DAY , COUNT( * ) AS visitors, COUNT( DISTINCT ip ) AS u_visitors
    FROM visit
    WHERE WEEK( visit_time ) = WEEK( NOW( ) ) 
    GROUP BY WEEK( visit_time )'

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


    function day_visitors(){
    $q = $this->db->query('
    SELECT visit_time AS DATE, YEAR( visit_time ) AS YEAR, MONTH( visit_time ) AS 
    MONTH , DAY( visit_time ) AS 
    DAY , COUNT( * ) AS visitors, COUNT( DISTINCT ip ) AS u_visitors
    FROM visit
    WHERE DAY( visit_time ) = DAY( NOW( ) ) 
    GROUP BY DAY( visit_time )'

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

    function year_visitors(){
    $q = $this->db->query('
    SELECT visit_time AS DATE, YEAR( visit_time ) AS YEAR, MONTH( visit_time ) AS 
    MONTH , DAY( visit_time ) AS 
    DAY , COUNT( * ) AS visitors, COUNT( DISTINCT ip ) AS u_visitors
    FROM visit
    WHERE YEAR( visit_time ) = YEAR( NOW( ) ) 
    GROUP BY YEAR( visit_time )'

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

    function day_lists(){
        $q = $this->db->query('
        SELECT TIME AS DATE, YEAR( TIME ) AS YEAR, MONTH( TIME ) AS 
        MONTH , DAY( TIME ) AS 
        DAY , COUNT( * ) AS nr_of_lists, COUNT( DISTINCT creator ) AS u_creators
        FROM list
        WHERE DAY( TIME ) = DAY( NOW( ) ) 
        GROUP BY DAY( TIME )'

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

      function week_lists(){
        $q = $this->db->query('
        SELECT TIME AS DATE, YEAR( TIME ) AS YEAR, MONTH( TIME ) AS 
        MONTH , DAY( TIME ) AS 
        DAY , COUNT( * ) AS nr_of_lists, COUNT( DISTINCT creator ) AS u_creators
        FROM list
        WHERE WEEK( TIME ) = WEEK( NOW( ) ) 
        GROUP BY WEEK( TIME )'

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

      function month_lists(){
        $q = $this->db->query('
        SELECT TIME AS DATE, YEAR( TIME ) AS YEAR, MONTH( TIME ) AS 
        MONTH , DAY( TIME ) AS 
        DAY , COUNT( * ) AS nr_of_lists, COUNT( DISTINCT creator ) AS u_creators
        FROM list
        WHERE MONTH( TIME ) = MONTH( NOW( ) ) 
        GROUP BY MONTH( TIME )'

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

      function year_lists(){
        $q = $this->db->query('
        SELECT TIME AS DATE, YEAR( TIME ) AS YEAR, MONTH( TIME ) AS 
        MONTH , DAY( TIME ) AS 
        DAY , COUNT( * ) AS nr_of_lists, COUNT( DISTINCT creator ) AS u_creators
        FROM list
        WHERE YEAR( TIME ) = YEAR( NOW( ) ) 
        GROUP BY YEAR( TIME )'

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