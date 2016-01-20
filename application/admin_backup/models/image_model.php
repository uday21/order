<?php

class image_model extends CI_Model {

    public function insert_file($data, $imgdata)
    {
        $imgdata = file_get_contents($imgdata['full_path']);

        $params = array(
            'name' => $data,
            'logo' => $imgdata
        );

        $this->db->insert('restaurant', $params);
        return $this->db->insert_id();
    }

    public function update_file($data, $imgdata, $id)
    {
        $imgdata = file_get_contents($imgdata['full_path']);

        $params = array(
            'name' => $data,
            'logo' => $imgdata
        );


        $this->db->where('id', $id);
        $this->db->update('restaurant', $params);
        return true;
    }


    public function insert_imagefile($data, $imgdata)
    {
        $imgdata = file_get_contents($imgdata['full_path']);

        $params = array(
            'name' => $data,
            'binary_details' => $imgdata
        );

        $this->db->insert('menu_images', $params);
        return $this->db->insert_id();
    }

    public function update_imagefile($data, $imgdata, $id)
    {
        $imgdata = file_get_contents($imgdata['full_path']);

        $params = array(
            'name' => $data,
            'binary_details' => $imgdata
        );

        $this->db->where('id', $id);
        $this->db->update('menu_images', $params);
        return true;
    }

}
?>