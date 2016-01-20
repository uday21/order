<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model( 'Data_model');
    }


    function check_existence_get()
    {
        $name = $this->post('name');
        $key = $this->post('key');
        $table = $this->post('grid');
        $data = $this->Data_model->checkData($name, $key, $table);


        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function databranch_get()
    {
        $data = $this->Data_model->rawQuery('SELECT branch.id, branch.branch, branch.restaurant, restaurant.name, branch.address,  branch.area, branch.city, branch.pincode, branch.menu_id, branch.account_id FROM branch LEFT JOIN restaurant ON restaurant.id = branch.restaurant');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function dataBranchById_get()
    {
        $id = $this->get('id');
		
		$data = $this->Data_model->rawQuery("SELECT branch.id, branch.branch, branch.restaurant, restaurant.name, branch.address,  branch.area, branch.city, branch.pincode, branch.menu_id, branch.account_id, branch.min_order  FROM branch LEFT JOIN restaurant ON restaurant.id = branch.restaurant WHERE branch.id=$id");

        //$data = $this->Data_model->getDataById($id, 'branch');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
	
	function getRestaurantById_get($id)
    {
        $id = $this->get('id');
		
		$data = $this->Data_model->getDataById($id, 'restaurant');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
	
	function getOfferById_get($id)
    {
        $id = $this->get('id');
		
		$data = $this->Data_model->getDataById($id, 'offers');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function datacategory_get()
    {
        $data = $this->Data_model->rawQuery('SELECT menu_category.id, menu_category.name, menu_category.menu_id, menu.name AS hotel FROM menu_category LEFT JOIN menu ON menu_category.menu_id = menu.id');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function datacategoryId_get()
    {
        $id = $this->get('id');

        $data = $this->Data_model->getDataById($id, 'menu_category');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }


    function dataMenuById_get()
    {
        $id = $this->get('id');

        $data = $this->Data_model->getDataById($id, 'menu_items');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function dataIngreGroupById_get()
    {
        $id = $this->get('id');

        $data = $this->Data_model->getDataById($id, 'ingredient_group');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function dataIngredientById_get()
    {
        $id = $this->get('id');

        $data = $this->Data_model->getDataById($id, 'ingredient');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
	
	function datacityId_get()
    {
        $id = $this->get('id');

        $data = $this->Data_model->getDataById($id, 'city');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
	
	function dataareaId_get()
    {
        $id = $this->get('id');

        $data = $this->Data_model->getDataById($id, 'area');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
	
	function datadeliveryChargeId_get()
    {
        $id = $this->get('id');

        $data = $this->Data_model->getDataById($id, 'kilometre');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
	
	function datadeliveryChargeTempId_get()
    {
        $id = $this->get('id');

        $data = $this->Data_model->getDataById($id, 'delivery_charge');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }


    function datamenus_get()
    {
        $data = $this->Data_model->getMenus('SELECT menu_items.id, menu_items.name, menu_items.price, menu_category.name as category, menu_images.binary_details FROM menu_items LEFT JOIN menu_category ON menu_items.menu_category = menu_category.id	LEFT JOIN menu_images ON menu_items.image_id = menu_images.id');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function dataimage_get()
    {
        $data = $this->Data_model->getFoodImage();

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

	function restaurantfull_get()
    {
        $data = $this->Data_model->getRestaurantAll();

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	function menubyhotel_get()
    {
		$id = $this->get('id');
		$data = "";
		
		if($this->get('userid')) {
			$data = $this->Data_model->getmenubyUserID($id, $this->get('userid'));
		} else {
			$data = $this->Data_model->getmenubyID($id);
		}
		
        

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function favbyhotel_get()
    {
		$id = $this->get('id');
	
		$data = $this->Data_model->getfavbyUserID($id, $this->get('userid'));
		
        

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }



    function restaurant_get()
    {
        $data = $this->Data_model->getRestaurant();

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function restaurant_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('restaurant', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function restaurant_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'restaurant');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function restaurant_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id,'restaurant');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	 function offer_get()
    {
        $data = $this->Data_model->getOffer();

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function offer_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('offers', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function offer_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'offers');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function offer_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id,'offers');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	
	function viewBranch_get() {
		$id = $this->get('id');
		$data = $this->Data_model->getRestaurantBranch($id);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
	}
	
	function branchbylocation_get() {
		$location = $this->get('city');
		$data = $this->Data_model->getRestaurantBranchByLocation($location);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
	}
	
	function areabyLocation_get()
    {

        $id = $this->get('id');
        $data = $this->Data_model->getAreaByLocation($id);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	function viewAccount_get() {
		$id = $this->get('id');
		$data = $this->Data_model->getRestaurantAccount($id);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
	}


    function menuImage_get()
    {
        $data = $this->Data_model->getMenuImage('menu_images');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function branch_get()
    {


        
        $data = $this->Data_model->getData('branch');
        if($data)
        {
            $this->response($data, 200);
        }

        else
        {
            $this->response(NULL, 404);
        }

    }

    function branch_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('branch', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function branch_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'branch');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function branch_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'branch');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function menuId_get()
    {

        
        $data = $this->Data_model->getData('menu');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function menuId_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('menu', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function menuId_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'branch');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function menuId_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'menu');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function accountDetails_get()
    {

        
        $data = $this->Data_model->getData('account_details');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function accountDetails_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('account_details', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function accountDetails_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'account_details');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function accountDetails_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'account_details');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function notificationDetails_get()
    {

        
        $data = $this->Data_model->getData('notification');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function notificationDetails_post()
    {
		
		$notify = $this->post('notify');
		$date = $this->post('notify');

        $params = array("notifications" => $notify, "curr_date" => date("Y-m-d H:i:s")); 
        
        $data = $this->Data_model->addnotifyInsert('notification', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }



    function category_get()
    {

        
        $data = $this->Data_model->getData('menu_category');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function category_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $name = $params['name'];
		$menu = $params['menu_id'];


        $check = $this->Data_model->checkCatNameExists('menu_category', $name, $menu);

        if ($check == 0) {

            $data = $this->Data_model->addData('menu_category', $params);
            echo $check;

        } else if($check > 0) {
            echo $check;
        }
    }

    function category_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'menu_category');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function category_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'menu_category');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }





    function menuItems_get()
    {

        
        $data = $this->Data_model->getData('menu_items');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function menuItems_post()
    {

        
        $params = json_decode($this->post('data'), true);
		$name = $params['name'];
		$category = $params['menu_category'];
		
		$check = $this->Data_model->checkCatNameExists('menu_items', $name, $category);

        if ($check == 0) {

            $data = $this->Data_model->addData('menu_items', $params);
            echo $check;

        } else if($check > 0) {
            echo $check;
        }
    }

    function menuItems_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'menu_items');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function menuItems_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'menu_items');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }



    function menuGroup_get()
    {

        
        $data = $this->Data_model->getData('menu_group');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function menuGroup_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('menu_group', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function menuGroup_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'menu_group');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function menuGroup_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'menu_group');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function ingredientGroup_get()
    {


        $data = $this->Data_model->getIngredientGroup();
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function ingredientGroup_post()
    {


        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('ingredient_group', $params);
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function ingredientGroup_update_post()
    {


        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'ingredient_group');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }


    function ingredientGroup_remove_post()
    {


        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'ingredient_group');
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }


    function ingredient_get()
    {


        $data = $this->Data_model->getData('ingredient');
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function ingredient_post()
    {


        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('ingredient', $params);
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }

    function ingredient_update_post()
    {


        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'ingredient');

        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }


    function ingredient_remove_post()
    {


        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'ingredient');
        if ($data) {
            $this->response($data, 200);
        } else {
            $this->response(NULL, 404);
        }
    }












    function users_get()
    {

        
        $data = $this->Data_model->getData('users');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function users_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('users', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function users_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'users');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function users_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'users');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function transaction_get()
    {

        
        $data = $this->Data_model->getData('transaction');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function transaction_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('transaction', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function transaction_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'transaction');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function transaction_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'transaction');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }



    function customer_get()
    {

        
        $data = $this->Data_model->getData('customer');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function customer_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('customer', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function customer_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'customer');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function customer_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'customer');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function favourite_restaurant_post()
    {
		
		$postdata = file_get_contents("php://input");

		$request = json_decode($postdata);
		$customer = $request->customerid;
		$menu = $request->menu;
		$restaurant = $request->restaurant;
		

		
		$checkrestaurant = $this->Data_model->getFavouriteData($customer, $restaurant);
		
		if($checkrestaurant < 1)
        {
			$restaurantparams = array("customer_id" => $customer, "restaurant_id" => $restaurant);
			$restaurantfav = $this->Data_model->addData('favourite_restaurant', $restaurantparams);	
		}
		
		$times = $this->Data_model->getTotalTimes($customer, $menu);
		
	
			$itemparams = array("customer_id" => $customer, "menu_item_id" => $menu, "times_ordered" => $times);
			$data = $this->Data_model->addData('favourite_items', $itemparams);
			
			if($data)
			{
				$this->response($menu, 200);
			}
			else
			{
				$this->response(NULL, 404);
			}

        
    }

    function favourite_items_remove_post()
    {

        $postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
        $id = $request->menu;
        $data = $this->Data_model->deleteFavData($id, 'favourite_items');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function paymentDetails_get()
    {

        
        $data = $this->Data_model->getData('payment_details');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function paymentDetails_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('payment_details', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function paymentDetails_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'payment_details');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function paymentDetails_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'payment_details');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function address_get()
    {

        
        $data = $this->Data_model->getData('address');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function address_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('address', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function address_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'address');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function address_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'address');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function cityhasArea_get()
    {

        
        $data = $this->Data_model->getcitywithArea();
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

	function city_get()
    {

        
        $data = $this->Data_model->getData('city');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function city_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('city', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function city_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'city');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function city_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'city');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function availableArea_get()
    {

        $city = $this->get('city');
        $data = $this->Data_model->currentArea($city);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function area_get()
    {

        
        $data = $this->Data_model->getArea('area');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function area_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('area', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function area_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'area');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function area_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'area');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	function delivery_charge_get()
    {
        $data = $this->Data_model->getData('kilometre');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function delivery_charge_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('kilometre', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function delivery_charge_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'kilometre');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function delivery_charge_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id,'kilometre');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	function deliverytemp_charge_get()
    {
        $data = $this->Data_model->getData('delivery_charge');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function deliverytemp_charge_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('delivery_charge', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function deliverytemp_charge_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'delivery_charge');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function deliverytemp_charge_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id,'delivery_charge');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	
	function registered_users_get()
    {
        $data = $this->Data_model->getData('admin_users');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function registered_users_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('registered_users', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function registered_users_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'registered_users');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function registered_users_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'registered_users');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	

	
	function signup_get()
    {
        $data = $this->Data_model->getData('customer');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function signup_post()
    {

        $postdata = file_get_contents("php://input");
		
        $params = json_decode($postdata, true);
		$email = $params['email'];
		$mobile = $params['mobile'];
		
		$getemail = $this->Data_model->verifyEmail($email);
		$getmobile = $this->Data_model->verifyMobile($mobile);
		
		if($getemail > 0) {
			$this->response("Email Already Exists", 200);
		} else if($getmobile > 0) {
			$this->response("Mobile Already Exists", 200);
		} else {
			$data = $this->Data_model->addData('customer', $params);
			
			if($data)
			{
				$this->response($data, 200);
			}
			else
			{
				$this->response(NULL, 404);
			}
		}
        
        
    }

    function signup_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'customer');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function signup_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'customer');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	function login_post()
    {
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
		$request = json_decode($postdata);
		$email = $request->email;
		$password = $request->password;
		
		$data = $this->Data_model->getloginData($email, $password);
		
			if($data)
			{
				$this->response($data, 200);
			}
			else
			{
				$this->response(NULL, 404);
			}
		}
    }

	function useraddress_get()
    {
        $data = $this->Data_model->getData('address');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function useraddressbyid_get()
    {
		$id = $this->get('id');
        $data = $this->Data_model->getAddressDetailsById($id, 'address');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function useraddress_post()
    {

        $postdata = file_get_contents("php://input");
		
        $params = json_decode($postdata, true);
        $data = $this->Data_model->addData('address', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function useraddress_update_post()
    {
		
		$postdata = file_get_contents("php://input");
		$request = json_decode($postdata);
		
		$userid = $request->user_id;
		$city = $request->city;
		$location = $request->location;
		$company = $request->company;
		$flat = $request->flat;
		$apartment = $request->apartment;
		$postcode = $request->postcode;
		
		$params = array(
						"city" => $city,
						"location" => $location,
						"company" => $company, 
						"flat" => $flat,
						"apartment" => $apartment,
						"postcode" => $postcode);
		
		
        $data = $this->Data_model->updateAddressData($userid, $params, 'address');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function useraddress_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'customer');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function reorder_get()
    {
		$id = $this->get('id');
        $data = $this->Data_model->getReorderData($id);

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function thankyou_get()
    {
		
		$id = $this->get('id');
	
		$data = $this->Data_model->getemailData($id, 'order');
		
		if($data)
        {
			$this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
	
	}



    function order_get()
    {



        $data = $this->Data_model->getData('order');
        if($data)
        {
			$this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function order_post()
    {
		
		$postdata = file_get_contents("php://input");
		if (isset($postdata)) {
			$request = json_decode($postdata);
		$request = json_decode($postdata);
		$name = $request->name;
		$email = $request->email;
		$mobile = $request->mobile;
		$userid = $request->user_id;
		$delivery = $request->delivery_details;
		$payment = $request->payment;
		$restaurant = $request->restaurant_details;
		$price = $request->price;
		$orders = json_decode($request->orders, true);
		
		$address_id = $this->Data_model->getAddressById($userid, 'address');

		
		if($address_id) {
		$order_user = array(
						"name" => $name,
						"email" => $email,
						"mobile" => $mobile,
						"address_id" => $address_id, 
						"payment" => $payment,
						"customer_id" => $userid,
						"delivery_details" => $delivery,
						"price" => $price,
						"restaurant_details" => $restaurant,
						"ordered_date" => date('Y-m-d H:i:s'));
		
			$data = $this->Data_model->addDataInsert('order', $order_user);
			if($data)
			{
				$orderiddata = $data; //.date('YmdH');
				$paramUpdate = array("order_id" => $orderiddata);
				$this->Data_model->updateData($data, $paramUpdate, 'order');
				
				
				foreach($orders as $myorder) {
					$params = array("order_id" => $data,"item_id" => $myorder['id'],"item_options" => $myorder['quantity'], "price" => $myorder['price']);
					$data_items = $this->Data_model->addData('order_items', $params);
				}
				
				/*$uid="7368616c6f6d646576656c6f706d656e74"; //your uid
				$pin="5131e140ec9a2"; //your api pin
				$sender="SENDER"; // approved sender id
				$domain="server2.shalomsms.com"; // connecting url 
				$route="0";// 0-Normal,1-Priority
				$method="POST";
				
				$mobile="9597098554";
				
					$message="You got a new Order! Kindly check the admin panel.";
				
					$uid=urlencode($uid);
					$pin=urlencode($pin);
					$sender=urlencode($sender);
					$message=urlencode($message);
					
					$parameters="uid=$uid&pin=$pin&sender=$sender&route=$route&mobile=$mobile&message=$message ";
				
					$url="http://server2.shalomsms.com/api/sms.php";
				
					$ch = curl_init($url);
				
						curl_setopt($ch, CURLOPT_POST,1);
						curl_setopt($ch, CURLOPT_POSTFIELDS,$parameters);
				
				
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1); 
					curl_setopt($ch, CURLOPT_HEADER,0);  // DO NOT RETURN HTTP HEADERS 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);  // RETURN THE CONTENTS OF THE CALL
					$return_val = curl_exec($ch);*/
					
					$email_items = $this->Data_model->getemailData($data, 'order');
					
					if($email_items) {
						
						$name = $email_items[0]['name'];
		$mobile = $email_items[0]['mobile'];
		$email = $email_items[0]['email'];
						
						
		$date = $email_items[0]['ordered_date'];
		$date = date( "h:m A, d/m/Y", strtotime($date));

		$address = $email_items[0]['company'].' '.$email_items[0]['flat'].', '.$email_items[0]['apartment'].', '.$email_items[0]['location'].', '.$email_items[0]['city'].', '.$email_items[0]['postcode'];
		$address2 = $email_items[0]['company'].'<br>'.$email_items[0]['flat'].'<br>'.$email_items[0]['apartment'].'<br>'.$email_items[0]['location'].'<br>'.$email_items[0]['city'].'<br>'.$email_items[0]['postcode'];
		$price = $email_items[0]['price'];
		$hotel = $email_items[0]['restaurant'];
		$hotel_location = $email_items[0]['hotel_location'];
		$payment = $email_items[0]['payment'];
		
		$msg = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Welcome</title>
</head>
<body style='color: #000;font-family: Arial,Helvetica,sans-serif;font-size: 12px;font-weight: normal;line-height: 22px;margin: 0;padding: 0;'>
<br>
<br>
<table width='80%' height='195' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#840505' style='border-collapse: collapse; background: #f9f9f9;'>
  <tr bgcolor='#ef473a'>
    <td colspan='2' width='19%' height='19' align='center'><font style=italic color=White><b><font face=verdana color='white' size='-1'>NEW ORDER</font> &nbsp;</b></font></td>
  </tr>
  <tr>
    <td width='100%' colspan=2 height='5'><table width='100%' border='0' align='center' cellpadding='5' cellspacing='0'>
        <tr height='45px'>
          <td colspan='3'><div align='center'><font face='verdana' color='#000' size='2pt'><strong>Sender Details</strong></font></div></td>
        </tr>
        <tr>
          <td width='157'><font face='verdana' color='#000' size='2pt'>Name</font></td>
          <td width='5'>:</td>
          <td width='175'><font face=verdana color='black' size='-1'>$name</font></td>
        </tr>
        <tr>
          <td width='157'><font face='verdana' color='#000' size='2pt'>Mobile Number</font></td>
          <td width='5'>:</td>
          <td width='175'><font face=verdana color='black' size='-1'>$mobile</font></td>
        </tr>
        <tr>
          <td><font face='verdana' color='#000' size='2pt'>Ordered Time</font></td>
          <td>:</td>
          <td><font face=verdana color='black' size='-1'>$date</font></td>
        </tr>
        <tr>
          <td><font face='verdana' color='#000' size='2pt'>Address</font></td>
          <td>:</td>
          <td><font face=verdana color='black' size='-1'>$address</font></td>
        </tr>
        <tr>
          <td valign='top'><font face='verdana' color='#000' size='2pt'>Total Price</font></td>
          <td valign='top'>:</td>
          <td valign='top'><font face='verdana' color='black' size='-1'>Rs. $price </font></td>
        </tr>
        <tr>
          <td valign='top'><font face='verdana' color='#000' size='2pt'>Hotel</font></td>
          <td valign='top'>:</td>
          <td valign='top'><font face='verdana' color='black' size='-1'>$hotel</font></td>
        </tr>
        <tr>
          <td valign='top'><font face='verdana' color='#000' size='2pt'>Hotel Location</font></td>
          <td valign='top'>:</td>
          <td valign='top'><font face='verdana' color='black' size='-1'>$hotel_location</font></td>
        </tr>
        <tr>
          <td valign='top'><font face='verdana' color='#000' size='2pt'>Payment Mode</font></td>
          <td valign='top'>:</td>
          <td valign='top'><font face='verdana' color='black' size='-1'>$payment</font></td>
        </tr>
      </table>
      <table width='100%' border='1' style='border-collapse:collapse;' cellspacing='0' cellpadding='0'>
        <tr style='background:#000; color:#fff'>
          <th>S. No</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>";
		
		$i=0;
		foreach($email_items[0]['items'] as $items) {
			//for($i=0;$i<2;$i++) {
			$i++;
			
			$item_name =  $items['name'];
			$quantity =  $items['options'];
			$itemprice =  $items['price'];
			$msg .= "<tr style='text-align:center'><td>$i</td> <td>$item_name</td> <td>$quantity</td> <td>Rs. $itemprice</td></tr>";
		}
		
		
        $msg .= "</table></td></tr></table></body></html>";
					
					
					$config = Array(
					 'protocol' => 'smtp',
					 'smtp_host' => 'ssl://smtp.gmail.com',
					 'smtp_port' => 465,
					 'smtp_user' => 'uday@shalominfotech.com', // change it to yours
					 'smtp_pass' => 'uday5678', // change it to yours
					 'mailtype' => 'html',
					 'charset' => 'iso-8859-1'
				  );
				  
				  $this->load->library('email', $config);
				  $this->email->set_newline("\r\n");
			
								
					$this->email->from('harish@shalominfotech.com', 'Uday');
					$this->email->to('uday@shalominfotech.com');
								
					$this->email->subject('New Order');
					$this->email->message($msg);
								
					$this->email->send();
					
					
					
					$msg_user = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Welcome</title>
</head>
<body>
<div bgcolor='#ffffff' style='width:100%;min-height:100%;margin:10px auto;padding:0;background-color:#ffffff;font-family:Arial,Tahoma,Verdana,sans-serif;font-weight:299px;font-size:13px;text-align:center'>
  <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
    <tbody>
      <tr>
        <td width='10' style=' background:#ef473a; padding: 0; margin: 0'>&nbsp;</td>
        <td valign='middle' height='50' align='left' style='background: #ef473a ; padding: 0; margin: 0'><a target='_blank' href='' style='text-decoration:none;outline:none;color:#ffffff;font-size:13px'> <img src='http://demo12.shalominfotech.net/hotel_kannappa/images/mail_logo.png' alt='orderfoodnow.in' style='border:none' border='0'> </a></td>
        <td valign='middle' height='50' align='right' style='background:#ef473a; padding: 0; margin: 0'><a style='text-decoration:none;outline:none;color:#ffffff;font-size:12px'> <strong>Call:</strong> 9876543210 </a></td>
        <td width='10' style='background: #ef473a; padding: 0; margin: 0'>&nbsp;</td>
      </tr>
    </tbody>
  </table>
  <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
    <tbody>
      <tr>
        <td width='300' valign='top' align='center'><table width='100%' cellspacing='0' cellpadding='0' border='0' bgcolor='#005387'>
            <tbody>
            </tbody>
          </table></td>
        <td width='300' valign='top' align='center'></td>
      </tr>
    </tbody>
  </table>
  <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
    <tbody>
      <tr>
        <td align='left' valign='top' style='color:#2c2c2c;display:block;line-height:20px;font-weight:300;margin:0 auto;clear:both;border-bottom:1px solid #e6e6e6;background-color:#f9f9f9;padding:20px'><p style='padding:0;margin:0;font-size:16px;font-weight:bold;font-size:13px'> Hi $name, </p>
          <br>
          <p style='padding:0;margin:0;color:#565656;font-size:13px'> Thank you for your order! <br>
            <br>
            You will recieve a confirmation call to your phone number before 30-40 minutes of your delivery time. Orders will be processed only after phone confirmation. Kindly keep your mobile phone switched ON.</p>
          <br></td>
      </tr>
    </tbody>
  </table>
  <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
    <tbody>
      <tr>
        <td valign='top' bgcolor='' align='left' style='background-color:#ffffff;display:block;margin:0 auto;clear:both;padding:20px 20px 0 20px'><table width='100%' cellspacing='0' cellpadding='0' border='0' style='margin:0'>
            <tbody>
              <tr>
                <td width='100%' valign='top' align='left' colspan='4'><p style='padding:0;margin:0;color:#565656;line-height:22px;font-size:13px'> <strong>Please find below, your order details</strong> </p>
                  <br></td>
              </tr>
              <tr>
                <td valign='top' align='left' colspan='4'></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
  <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6; width:100%;
	margin:0;
	border:1px solid #666;
	border-collapse:collapse;'>
    <tr>
      <td style='background:#ef473a;
	color:#FFF;padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>Order ID:</td>
      <td style='padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>$data</td>
    </tr>
    <tr>
      <td style='background:#ef473a;
	color:#FFF;padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>Ordered Time: </td>
      <td style='padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>$date</td>
    </tr>
    <tr>
      <td style='background:#ef473a;
	color:#FFF;padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>Total Price:</td>
      <td style='padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>Rs. $price</td>
    </tr>
    <tr>
      <td style='background:#ef473a;
	color:#FFF;padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>Hotel:</td>
      <td style='padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>$hotel ($hotel_location)</td>
    </tr>
    <tr>
      <td style='background:#ef473a;
	color:#FFF;padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>Payment Mode:</td>
      <td style='padding:10px;
	border:1px solid #ccc;
	font-weight:bold;
	text-align:left;'>$payment</td>
    </tr>
    <tr>
  </table>
  <br>
  <br><table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6; border-right:solid 1px #e6e6e6; border-collapse:collapse;'>
    <tr style='background:#000; color:#fff; '>
      <th style='padding:10px;'>S. No</th>
      <th style='padding:10px;'>Name</th>
      <th style='padding:10px;'>Quantity</th>
      <th style='padding:10px;'>Price</th>
    </tr>";
  
 $j=0;
  foreach($email_items[0]['items'] as $items) {
			$j++;
			
			$item_name =  $items['name'];
			$quantity =  $items['options'];
			$itemprice =  $items['price'];
			$msg_user .= "<tr style='text-align:center'>
      <td style='padding:10px;'>$j </td>
      <td style='padding:10px;'>$item_name</td>
      <td style='padding:10px;'>$quantity </td>
      <td style='padding:10px;'>$itemprice</td>
    </tr>";
		}
  
  
  $msg_user .= "</table> <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
    <tbody>
      <tr>
        <td valign='top' bgcolor='#fff' align='center' style='background-color:#ffffff;display:block;margin:0 auto;clear:both;padding:5px 20px 0 20px'></td>
      </tr>
    </tbody>
  </table>
  <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
    <tbody>
      <tr>
        <td valign='top' bgcolor='' align='right' style='clear:both;display:block;margin:0 auto;padding:10px 20px 0 20px;background-color:#ffffff'><table width='100%' cellspacing='0' cellpadding='0'>
            <tbody>
              <tr>
                <td valign='top' align='right' style='border-top:2px solid #565656;border-bottom:1px solid #e6e6e6;padding:15px 0;margin:0;background-color:#f9f9f9'><p style='padding:0;margin:0;text-align:right;color:#565656;line-height:22px;white-space:nowrap;font-size:21px'> Total <span style='font-size:21px'>Rs. $price</span> </p></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
  <table width='100%' cellspacing='0' cellpadding='0' style='max-width:600px;border-left:solid 1px #e6e6e6;border-right:solid 1px #e6e6e6'>
    <tbody>
      <tr>
        <td valign='top' bgcolor='#ffffff' align='left' style='background-color:#ffffff;color:#565656;display:block;font-weight:300;margin:0;padding:0;clear:both'><table width='100%' cellspacing='0' cellpadding='0'>
            <tbody>
              <tr>
                <td valign='top' align='left' style='padding:20px 20px 0 20px;margin:0'><p style='margin:0;padding:0;color:#565656;font-size:13px'>DELIVERY ADDRESS</p>
                  <p style='padding:0;margin:15px 0 10px 0;font-size:18px;color:#333333'> $name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   $mobile </p>
                  <p style='line-height:18px;padding:0;margin:0;color:#565656;font-size:13px'> $address2 </p></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </tbody>
  </table>
</div>
</body>
</html>";
					
					
					
					
					$this->email->from('harish@shalominfotech.com', 'Uday');
					$this->email->to('uday@shalominfotech.com');
								
					$this->email->subject('Your order has been received!');
					$this->email->message($msg_user);
								
					$this->email->send();
						
					}

					
				
				$this->response($orderiddata, 200);
			}
			else
			{
				$this->response(NULL, 404);
			}
		  }
		}
        
        
    }
	
	function email_get() {
		
		$i=0;
					
		$orderdata = $this->Data_model->getemailData(1, 'order');
		//print_r($orderdata);
					
		if($orderdata) {
			
			//print_r($orderdata);
						
		$name = $orderdata[0]['name'];
		$mobile = $orderdata[0]['mobile'];
		$email = $orderdata[0]['email'];
						
						
		$date = $orderdata[0]['ordered_date'];
		$date = date( "h:m A, d/m/Y", strtotime($date));

		$address = $orderdata[0]['company'].' '.$orderdata[0]['flat'].', '.$orderdata[0]['apartment'].', '.$orderdata[0]['location'].', '.$orderdata[0]['city'].', '.$orderdata[0]['postcode'];
		$price = $orderdata[0]['price'];
		$hotel = $orderdata[0]['restaurant'];
		$hotel_location = $orderdata[0]['hotel_location'];
		$payment = $orderdata[0]['payment'];
		
		$msg = "<!doctype html>
<html>
<head>
<meta charset='utf-8'>
<title>Welcome</title>
</head>
<body style='color: #000;font-family: Arial,Helvetica,sans-serif;font-size: 12px;font-weight: normal;line-height: 22px;margin: 0;padding: 0;'>
<br>
<br>
<table width='80%' height='195' border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#840505' style='border-collapse: collapse; background: #f9f9f9;'>
  <tr bgcolor='#ef473a'>
    <td colspan='2' width='19%' height='19' align='center'><font style=italic color=White><b><font face=verdana color='white' size='-1'>NEW ORDER</font> &nbsp;</b></font></td>
  </tr>
  <tr>
    <td width='100%' colspan=2 height='5'><table width='100%' border='0' align='center' cellpadding='5' cellspacing='0'>
        <tr height='45px'>
          <td colspan='3'><div align='center'><font face='verdana' color='#000' size='2pt'><strong>Sender Details</strong></font></div></td>
        </tr>
        <tr>
          <td width='157'><font face='verdana' color='#000' size='2pt'>Name</font></td>
          <td width='5'>:</td>
          <td width='175'><font face=verdana color='black' size='-1'>$name</font></td>
        </tr>
        <tr>
          <td width='157'><font face='verdana' color='#000' size='2pt'>Mobile Number</font></td>
          <td width='5'>:</td>
          <td width='175'><font face=verdana color='black' size='-1'>$mobile</font></td>
        </tr>
        <tr>
          <td><font face='verdana' color='#000' size='2pt'>Ordered Time</font></td>
          <td>:</td>
          <td><font face=verdana color='black' size='-1'>$date</font></td>
        </tr>
        <tr>
          <td><font face='verdana' color='#000' size='2pt'>Address</font></td>
          <td>:</td>
          <td><font face=verdana color='black' size='-1'>$address</font></td>
        </tr>
        <tr>
          <td valign='top'><font face='verdana' color='#000' size='2pt'>Total Price</font></td>
          <td valign='top'>:</td>
          <td valign='top'><font face='verdana' color='black' size='-1'>Rs. $price </font></td>
        </tr>
        <tr>
          <td valign='top'><font face='verdana' color='#000' size='2pt'>Hotel</font></td>
          <td valign='top'>:</td>
          <td valign='top'><font face='verdana' color='black' size='-1'>$hotel</font></td>
        </tr>
        <tr>
          <td valign='top'><font face='verdana' color='#000' size='2pt'>Hotel Location</font></td>
          <td valign='top'>:</td>
          <td valign='top'><font face='verdana' color='black' size='-1'>$hotel_location</font></td>
        </tr>
        <tr>
          <td valign='top'><font face='verdana' color='#000' size='2pt'>Payment Mode</font></td>
          <td valign='top'>:</td>
          <td valign='top'><font face='verdana' color='black' size='-1'>$payment</font></td>
        </tr>
      </table>
      <table width='100%' border='1' style='border-collapse:collapse;' cellspacing='0' cellpadding='0'>
        <tr style='background:#000; color:#fff'>
          <th>S. No</th>
          <th>Name</th>
          <th>Quantity</th>
          <th>Price</th>
        </tr>";
		
		foreach($orderdata[0]['items'] as $items) {
			$i++;
			
			$item_name =  $items['name'];
			$quantity =  $items['options'];
			$price =  $items['price'];
			$msg .= "<tr style='text-align:center'><td>$i</td> <td>$item_name</td> <td>$quantity</td> <td>Rs. $price</td></tr>";
		}
		
		
        $msg .= "</table></td></tr></table></body></html>";
					
					}
					
					echo $msg;
		
	}


    function order_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'order');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function order_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'order');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	function orderStatus_update_post()
    {
        $id = $this->post('id');
		$status = $this->post('status');
		$params = array("status" => $status);
        $data = $this->Data_model->updateData($id, $params, 'order');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }




    function orderItems_get()
    {

        
        $data = $this->Data_model->getData('order_items');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function orderItems_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('order_items', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function orderItems_update_post()
    {

        
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'order_items');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function orderItems_remove_post()
    {

        
        $id = $this->post('id');
        $data = $this->Data_model->deleteData($id, 'order_items');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	
	
	
	
	
	
	
	
	function orderadmincount_get()
    {
        $id = $this->get('id');
        $data = $this->Data_model->getOrderCount();
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }
	
	
	
	function orderadmin_get()
    {
        $id = $this->get('id');
        $data = $this->Data_model->getOrderData($id);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


	function orderitemadmin() {
		
		$id = $this->post('id');
		$data = $this->Data_model->getOrderItemData($id);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
	}
	
	
	
	
	
	
	
	
	
	



    function  checkIfIdExists_get(){

        $id = $this->get('item_id');
        $data = $this->Data_model->checkMenuExists($id,'ingredient_group');
        if ($data > 0) {
            echo $data;
        }
    }


}

?>