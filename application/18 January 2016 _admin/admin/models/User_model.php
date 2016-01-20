<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User_model class.
 *
 * @extends CI_Model
 */
class User_model extends CI_Model {

    public function create_user($username, $password, $user) {

        $data = array(
            'username'   => $username,
            'password'   => $this->hash_password($password),
			'user_type'   => $user
            //'created_at' => date('Y-m-j H:i:s'),
        );

        return $this->db->insert('admin_users', $data);

    }


    private function hash_password($password) {

        return password_hash($password, PASSWORD_BCRYPT);

    }


    public function resolve_user_login($username, $password) {

        $this->db->select('password');
        $this->db->from('admin_users');
        $this->db->where('username', $username);
        $hash = $this->db->get()->row('password');

        return $this->verify_password_hash($password, $hash);

    }

    public function get_user_id_from_username($username) {

        $this->db->select('id');
        $this->db->from('admin_users');
        $this->db->where('username', $username);

        return $this->db->get()->row('id');

    }


    public function get_user($user_id) {

        $this->db->from('admin_users');
        $this->db->where('id', $user_id);
        return $this->db->get()->row();

    }
	
	
	public function getUsertype() {
       $this->db->select("*");
        $this->db->from("user_credential");
        $query = $this->db->get();
        $row = $query->result();
		$data[''] = 'Please Select';
		foreach ($row as $rows) {
			$data[$rows->id] = $rows->name;
		}

        return $data;
    }

    private function verify_password_hash($password, $hash) {

        return password_verify($password, $hash);

    }

}

?>