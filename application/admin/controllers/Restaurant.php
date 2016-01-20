<?php

class restaurant extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
        $this->load->helper('form');
        $this->load->library(array('session'));
        $this->load->library('form_validation');

    }

    public function register()
    {


       $this->load->model('user_model');

       $data = new stdClass();
	   
	   $selectoption = $this->user_model->getUsertype();
		
		$data->users = $selectoption;

        // set validation rules
        $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[admin_users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
        // $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');

        if ($this->form_validation->run() === false) {

            // validation not ok, send validation errors to the view
			$this->load->view('common');
            $this->load->view('register', $data);

        } else {

            // set variables from the form
            $username = $this->input->post('username');
            //$email    = $this->input->post('email');
            $password = $this->input->post('password');
			$user = $this->input->post('user');

            if ($this->user_model->create_user($username, $password, $user)) {

                // user creation ok
				$this->load->view('common');
                $this->load->view('registeredUsers');

            } else {

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                // send error to the view
				$this->load->view('common');
                $this->load->view('register', $data);

            }

        }



    }

    public function dashboard()
    {
        $this->load->view('common');
        $this->load->view('dashboard');
    }

    public function restaurant()
    {
        $this->load->view('common');
        $this->load->view('restaurant');
    }

    public function add_restaurant()
    {


        $this->load->model('user_model');

        $data = new stdClass();

        // set validation rules
        $this->form_validation->set_rules('hotelname', 'name', 'trim|required|alpha_numeric|min_length[4]|is_unique[restaurant.name]', array('is_unique' => 'This username already exists. Please choose another one.'));


        if ($this->form_validation->run() === false) {

            // validation not ok, send validation errors to the view
            $this->load->view('common');
            $this->load->view('addRestaurant', $data);

        } else {

            // set variables from the form
            $username = $this->input->post('username');
            //$email    = $this->input->post('email');
           // $password = $this->input->post('password');

            if ($this->user_model->create_user($username)) {

                // user creation ok
                $this->load->view('common');
                $this->load->view('addRestaurant', $data);

            } else {

                // user creation failed, this should never happen
                $data->error = 'There was a problem creating your new account. Please try again.';

                $this->load->view('common');
                $this->load->view('addRestaurant', $data);

            }

        }


    }

    public function branch()
    {
        $this->load->view('common');
        $this->load->view('branch');
    }

    public function add_branch()
    {
        $this->load->view('common');
        $this->load->view('addBranch');
    }

    public function account()
    {
        $this->load->view('common');
        $this->load->view('account');
    }

    public function add_account()
    {
        $this->load->view('common');
        $this->load->view('addAccount');
    }

    public function images()
    {
        $this->load->view('common');
        $this->load->view('images');
    }

    public function add_image()
    {
        $this->load->view('common');
        $this->load->view('addImage');
    }

    public function category()
    {
        $this->load->view('common');
        $this->load->view('category');
    }

    public function ingredient()
    {
        $this->load->view('common');
        $this->load->view('ingredient');
    }

    public function ingredientgroup()
    {
        $this->load->view('common');
        $this->load->view('ingredientgroup');
    }

    public function add_category()
    {
        $this->load->view('common');
        $this->load->view('addCategory');
    }

    public function menus()
    {
        $this->load->view('common');
        $this->load->view('menus');
    }

    public function add_menus()
    {
        $this->load->view('common');
        $this->load->view('addMenus');
    }

    public function add_menugroup()
    {
        $this->load->view('common');
        $this->load->view('addMenuGroup');
    }

    public function add_ingredientgroup()
    {
        $this->load->view('common');
        $this->load->view('addIngredientGroup');
    }

    public function add_ingredient()
    {
        $this->load->view('common');
        $this->load->view('addIngredient');
    }

    public function add_users()
    {
        $this->load->view('common');
        $this->load->view('addUsers');
    }

    public function view_branch()
    {
        $this->load->view('viewBranch');
    }

    public function view_account()
    {
        $this->load->view('viewAccount');
    }
	
	public function city()
    {
        $this->load->view('common');
        $this->load->view('city');
    }
	
	public function add_city()
    {
        $this->load->view('common');
        $this->load->view('addCity');
    }
	
	public function area()
    {
        $this->load->view('common');
        $this->load->view('area');
    }
	
	public function add_area()
    {
        $this->load->view('common');
        $this->load->view('addArea');
    }
	
	public function delivery_charge()
    {
        $this->load->view('common');
        $this->load->view('deliveryChargeTemp');
    }
	
	public function add_delivery_charge()
    {
        $this->load->view('common');
        $this->load->view('addDeliveryChargeTemp');
    }
	
	public function user_credentials()
    {
        $this->load->view('common');
        $this->load->view('userCredentials');
    }
	
	public function add_user_credentials()
    {
        $this->load->view('common');
        $this->load->view('addUserCredentials');
    }
	
	public function registered_users()
    {
        $this->load->view('common');
        $this->load->view('registeredUsers');
    }
	
	public function allocate_hotels()
    {
        $this->load->view('common');
        $this->load->view('allocateHotels');
    }
	
	public function orders()
    {
        $this->load->view('common');
        $this->load->view('orders');
    }
	
	public function offers()
    {
        $this->load->view('common');
        $this->load->view('offers');
    }
	
	public function add_offers()
    {
        $this->load->view('common');
        $this->load->view('addOffers');
    }
	
	public function notifications()
    {
        $this->load->view('common');
        $this->load->view('notifications');
    }
	
	public function send_notifications()
    {
        $this->load->view('common');
        $this->load->view('send_notifications');
    }

} 