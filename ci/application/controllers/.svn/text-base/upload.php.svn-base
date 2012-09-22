<?php

class Upload extends CI_Controller {

    function index() {
        $this->load->view('picture_upload_view', array('error' => ' '));
    }

    function do_upload() {
        $config['upload_path'] = './uploads/user_pics';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '1000';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = 'true';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('picture_upload_view', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data();

            $sql = "UPDATE  user SET  user_pic_path = ? WHERE  userID= ? ";

            $this->db->query($sql, array('uploads/user_pics/' . $upload_data['file_name'], $this->session->userdata('userID')));


            redirect('site/profile');
        }
    }


     // Tar bort den inloggade användarens bild
    function remove_pic() {
        $this->load->model('profile_model');

        $glass=$this->profile_model->remove_pic();

        redirect('site/profile');

       
    }
}

?>