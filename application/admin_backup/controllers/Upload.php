<?php

class upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    /*public function index()
    {
        $this->load->view('addRestaurant', array('error' => ' ' ));
    }*/



    public function do_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload('userfile'))
        {
			$this->validation->set_message('userfile',$this->upload->display_errors());
        return false;
        }
        else
        {
            $this->load->model('image_model');

            $id = $this->input->post('id');

            if(isset($id)) {
                $this->image_model->update_file($this->input->post('hotelname'), $this->upload->data(), $id);
            } else {
                $this->image_model->insert_file($this->input->post('hotelname'), $this->upload->data());
            }


            $data = $this->upload->data();
            unlink('./uploads/'.$data['raw_name'].$data['file_ext']);
            redirect('restaurant/restaurant');


        }
    }

    public function uploadimage()
    {
        $this->load->view('addImage', array('error' => ' ' ));
    }


    public function image_upload()
    {
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 1000;
        $config['max_width']            = 5000;
        $config['max_height']           = 5000;

        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload('userfile'))
        {
			$this->validation->set_message('userfile',$this->upload->display_errors());
        	return false;
        }
        else
        {
            $this->load->model('image_model');

            $id = $this->input->post('id');

            if(isset($id)) {
                $this->image_model->update_imagefile($this->input->post('foodname'), $this->upload->data(), $id);
            } else {
                $this->image_model->insert_imagefile($this->input->post('foodname'), $this->upload->data());
            }



            $data = $this->upload->data();
            unlink('./uploads/'.$data['raw_name'].$data['file_ext']);
            redirect('restaurant/images');

        }
    }
}
?>