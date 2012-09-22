<?php

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $data = array(
            'ip' => $this->session->userdata('ip_address'),
            'userid' => $this->session->userdata('userID')
        );
        $this->db->insert('visit', $data);
    }

    function index() {
        if ($this->session->userdata('is_admin')) {
            $data['title'] = 'Gimme5: Admin - Statistics';

            $this->load->model('statistics_model');
            $data['visitors'] = $this->statistics_model->visitors();
            $data['created'] = $this->statistics_model->created_lists_and_users();
            $data['month_visitors']= $this->statistics_model->month_visitors();
            $data['week_visitors']= $this->statistics_model->week_visitors();
            $data['day_visitors']=  $this->statistics_model->day_visitors();
            $data['year_visitors']=  $this->statistics_model->year_visitors();

            $data['month_lists']= $this->statistics_model->month_lists();
            $data['week_lists']= $this->statistics_model->week_lists();
            $data['day_lists']=  $this->statistics_model->day_lists();
            $data['year_lists']=  $this->statistics_model->year_lists();


            $data['created_lists'] = $this->statistics_model->created_lists();
            $data['registered_users'] = $this->statistics_model->registered_users();
            $this->load->view('includes/header', $data);
            $this->load->view('admin_view', $data);
            $this->load->view('includes/footer');
        } else {
            echo "RESTRICED ACCESS, GO ";
            echo anchor('site', 'BACK');
        }
    }

}