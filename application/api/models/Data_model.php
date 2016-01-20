<?php if (  ! defined( 'BASEPATH')) exit( 'No direct script access allowed');
class Data_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function getRestaurant() {
        $this->db->select("id,name,logo");
        $this->db->from('restaurant');
        $query = $this->db->get();
        $items = array();
        if($query->num_rows() > 0) {

            foreach ($query->result_array() as $row)
            {
                $row['logo'] = base64_encode($row['logo']);
                $items[] = $row;
            }

        }
        return $items;
    }
	
	function getOffer() {
        $this->db->select("id,name,offer_image");
        $this->db->from('offers');
        $query = $this->db->get();
        $items = array();
        if($query->num_rows() > 0) {

            foreach ($query->result_array() as $row)
            {
                $row['offer_image'] = base64_encode($row['offer_image']);
                $items[] = $row;
            }

        }
        return $items;
    }
	
	function getRestaurantAll() {
        $this->db->select("restaurant.name, branch.location, branch.menu_id, restaurant.logo");
        $this->db->from('restaurant');
        $this->db->join('branch', 'restaurant.id = branch.restaurant', 'LEFT');
        $query = $this->db->get();
        $items = array();
        if($query->num_rows() > 0) {

            foreach ($query->result_array() as $row)
            {
                $row['logo'] = base64_encode($row['logo']);
                $items[] = $row;
            }

        }
        return $items;
    }
	
	function getmenubyID($id) {

		$this->db->select('menu_category.id, menu_category.name');
		$this->db->from('menu_items');
		$this->db->join('menu_category', 'menu_items.menu_category = menu_category.id', 'LEFT');
		$this->db->where('menu_category.menu_id',$id);
		$this->db->group_by('menu_category.id');
		$this->db->order_by('menu_category.name');
		$query = $this->db->get();
		
		$json_response = array();
		
		foreach ($query->result() as $row) {
			
			$row_array = array();
        	$row_array['name'] = $row->name;  
        	$row_array['items'] = array();
			
			$this->db->select('id, name, price, menu_category');
			$this->db->from('menu_items');
			$this->db->order_by("name");
			$this->db->where('menu_category', $row->id);
			$query2 = $this->db->get();
			
			foreach ($query2->result() as $row2) {
				$row_array['items'][] = array(
				'id' => $row2->id,
                'name' => $row2->name,
                'price' => $row2->price
            	);
			}
			array_push($json_response, $row_array);
		}
		return  $json_response;
		
    }
	
	function getemailData($id, $table) {
		$this->db->select('order.id, order.name, order.mobile, order.email, address.city,  address.location, address.company, address.flat, address.apartment, address.postcode, order.payment, order.customer_id, order.delivery_details, order.price, restaurant.name AS restaurant, branch.area AS hotel_location, order.ordered_date');
		$this->db->from('orderdb.order');
		$this->db->join('address', 'order.address_id = address.id', 'LEFT');
		$this->db->join('branch', 'order.restaurant_details = branch.id', 'LEFT');
		$this->db->join('restaurant', 'branch.restaurant = restaurant.id', 'LEFT');
		$this->db->where('order.id',$id);
		$query = $this->db->get();
		
		$json_response = array();
		
		foreach ($query->result() as $row) {
			
			$row_array = array();
        	$row_array['name'] = $row->name; 
			$row_array['mobile'] = $row->mobile;
			$row_array['email'] = $row->email;
			$row_array['city'] = $row->city;
			$row_array['location'] = $row->location;
			$row_array['company'] = $row->company;
			$row_array['flat'] = $row->flat;
			$row_array['apartment'] = $row->apartment;
			$row_array['postcode'] = $row->postcode;
			$row_array['payment'] = $row->payment;
			$row_array['customer_id'] = $row->customer_id; 
			$row_array['delivery_details'] = $row->delivery_details;
			$row_array['price'] = $row->price;
			$row_array['restaurant'] = $row->restaurant;
			$row_array['hotel_location'] = $row->hotel_location;
			$row_array['ordered_date'] = $row->ordered_date;
        	$row_array['items'] = array();
			
			$this->db->select('order_items.order_id, menu_items.name, order_items.item_options, order_items.price');
			$this->db->from('order_items');
			$this->db->join('menu_items', 'order_items.item_id = menu_items.id', 'LEFT');
			$this->db->order_by("menu_items.name");
			$this->db->where('order_items.order_id', $id);
			
			$query2 = $this->db->get();
			
			foreach ($query2->result() as $row2) {
				$row_array['items'][] = array(
                'name' => $row2->name,
                'options' => $row2->item_options,
                'price' => $row2->price
            	);
			}
			
			array_push($json_response, $row_array);
			
		}
		
		return  $json_response;
		
	}
	
	function getmenubyUserID($id, $customer) {

		$this->db->select('menu_category.id, menu_category.name');
		$this->db->from('menu_items');
		$this->db->join('menu_category', 'menu_items.menu_category = menu_category.id', 'LEFT');
		$this->db->where('menu_category.menu_id',$id);
		$this->db->group_by('menu_category.id');
		$this->db->order_by('menu_category.name');
		$query = $this->db->get();
		
		$json_response = array();
		
		foreach ($query->result() as $row) {
			
			$row_array = array();
        	$row_array['name'] = $row->name;  
        	$row_array['items'] = array();
			
			$this->db->select('menu_items.id, menu_items.name, menu_items.price, menu_items.menu_category, IF(favourite_items.menu_item_id IS NULL,0,1) AS favourite, IF(customer.id IS NULL,0,customer.id) AS customer');
			$this->db->from('menu_items');
			$this->db->join('favourite_items', 'favourite_items.menu_item_id = menu_items.id', 'LEFT');
			$this->db->join('customer', 'favourite_items.customer_id = customer.id', 'LEFT');
			$this->db->order_by("menu_items.name");
			$this->db->where('menu_items.menu_category', $row->id);
			//$this->db->where(array('menu_items.menu_category' => $row->id, 'customer.id' => $customer));
			$query2 = $this->db->get();
			
			foreach ($query2->result() as $row2) {
				$row_array['items'][] = array(
				'id' => $row2->id,
                'name' => $row2->name,
                'price' => $row2->price,
                'favourite' => $row2->favourite,
                'customer' => $row2->customer
            	);
			}
			array_push($json_response, $row_array);
		}
		return  $json_response;
		
    }
	
	
	function getfavbyUserID($id, $customer) {

		$this->db->select('menu_category.id, menu_category.name');
		$this->db->from('menu_items');
		$this->db->join('menu_category', 'menu_items.menu_category = menu_category.id', 'LEFT');
		$this->db->where('menu_category.menu_id',$id);
		$this->db->group_by('menu_category.id');
		$this->db->order_by('menu_category.name');
		$query = $this->db->get();
		
		$json_response = array();
		
		foreach ($query->result() as $row) {
			
			$row_array = array();
        	$row_array['name'] = $row->name;  
        	$row_array['items'] = array();
			
			$this->db->select('menu_items.id, menu_items.name, menu_items.price, menu_items.menu_category, IF(favourite_items.menu_item_id IS NULL,0,1) AS favourite, IF(customer.id IS NULL,0,customer.id) AS customer');
			$this->db->from('menu_items');
			$this->db->join('favourite_items', 'favourite_items.menu_item_id = menu_items.id', 'LEFT');
			$this->db->join('customer', 'favourite_items.customer_id = customer.id', 'LEFT');
			$this->db->order_by("menu_items.name");
			$this->db->where(array('menu_items.menu_category' => $row->id, 'customer.id' => $customer));
			$query2 = $this->db->get();
			
			foreach ($query2->result() as $row2) {
				$row_array['items'][] = array(
				'id' => $row2->id,
                'name' => $row2->name,
                'price' => $row2->price,
                'favourite' => $row2->favourite,
                'customer' => $row2->customer
            	);
			}
			array_push($json_response, $row_array);
		}
		return  $json_response;
		
    }
	
	function getMenuImage($table) {
        $this->db->select("id,name,binary_details");
        $this->db->from($table);
        $query = $this->db->get();
        $items = array();
        if($query->num_rows() > 0) {

            foreach ($query->result_array() as $row)
            {
                $row['binary_details'] = base64_encode($row['binary_details']);
                $items[] = $row;
            }

        }
        return $items;
    }
	
	function getRegisteredUsers($table){

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where_not_in('username', array('admin'));
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;

    }
	
	function getDataById($id,$table){

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        $row = $query->result_array();

        return $row;

    }

    function getFoodImage() {
        $this->db->select("id,name,binary_details");
        $this->db->from('menu_images');
        $query = $this->db->get();
        $items = array();
        if($query->num_rows() > 0) {

            foreach ($query->result_array() as $row)
            {
                $row['binary_details'] = base64_encode($row['binary_details']);
                $items[] = $row;
            }

        }
        return $items;
    }
	
	function getIngredientGroup(){
        $this->db->select('t1.name, t3.type, t3.other_properties, t2.id');
        $this->db->from('ingredient_group AS t2');
        $this->db->join('menu_items AS t1', 't1.id = t2.item_id', 'LEFT');
        $this->db->join('ingredient AS t3', 't2.ingredient_id = t3.id', 'LEFT');
        $query = $this->db->get();
        $items = array();
        $count = $query->num_rows();
        if($count > 0) {
            foreach ($query->result_array() as $row)
            {
                $row['name'] = $row['name'];
                $items[] = $row;
            }

        }
        //print_r($items);
        return $items;
    }

    function getByLocation() {
        //$this->db->select("id,name");
        //$this->db->from('restaurant');
        $this->db->select('restaurant.*, branch.*');
        $this->db->from('restaurant');
        $this->db->join('branch', 'restaurant.id = branch.restaurant', 'LEFT');
        $query = $this->db->get();
        $items = array();
        $count = $query->num_rows();
        if($count > 0) {
            foreach ($query->result_array() as $row)
            {
                 $row['logo'] = base64_encode($row['logo']);
                 $items[] = $row;
            }

        }
        //print_r($items);
        return $items;
    }

    function getMenus($myquery) {
        $query = $this->db->query($myquery);
        $items = array();
        $count = $query->num_rows();
        if($count > 0) {
            foreach ($query->result_array() as $row)
            {
                $row['binary_details'] = base64_encode($row['binary_details']);
                $items[] = $row;
            }

        }
        //print_r($items);
        return $items;
    }

    function getImage($myquery) {
        $query = $this->db->query($myquery);
        $items = array();
        $count = $query->num_rows();
        if($count > 0) {
            foreach ($query->result_array() as $row)
            {
                $row['binary_details'] = base64_encode($row['binary_details']);
                $items[] = $row;
            }

        }
        //print_r($items);
        return $items;
    }



    function getRestaurantBranch($id) {
        $this->db->select("*");
        $this->db->from('branch');
        $this->db->where('restaurant', $id);
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function getAreaByLocation($id) {
        $this->db->select("*");
        $this->db->from('area');
        $this->db->where('city', $id);
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function getRestaurantBranchByLocation($location) {
        $this->db->select("branch.id, branch.branch, branch.restaurant, branch.address, branch.area, branch.min_order, city.name AS city, branch.pincode, branch.menu_id, branch.account_id");
        $this->db->from('branch');
		$this->db->join('city', 'branch.city = city.id', 'LEFT');
        $this->db->where('branch.city', $location);
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function getcitywithArea() {
        $this->db->select("city.id, city.name");
        $this->db->from('area');
		$this->db->join('city', 'area.city = city.id', 'LEFT');
		$this->db->group_by('city.id');
		$this->db->order_by('city.name');
        $query = $this->db->get();

        return $query->result_array();
    }
	
	function getArea($table) {
         $this->db->select("area.id, area.name, city.name as city");
        $this->db->from($table);
        $this->db->join('city', 'area.city = city.id', 'LEFT');
        $query = $this->db->get();

        return $query->result_array();
    }

    function checkData($name, $key, $table) {
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($key, $name);
        $this->db->get();

        return true;
    }
	
	function currentArea($city) {
        $this->db->select("name");
        $this->db->from('area');
        $this->db->where('city', $city);
        $query = $this->db->get();
		
		$items = array();
        $count = $query->num_rows();
        if($count > 0) {
            foreach ($query->result_array() as $row)
            {
                $items[] = $row['name'];
            }

        }
        return $items;

    }
	
	function getOrderCount() {
        $this->db->select("order.id, order.price, order.name, order.mobile, order.email, order.delivery_details, branch.branch, address.city, address.location, address.company, address.flat, address.apartment, address.postcode, order.status");
        $this->db->from('orderdb.order');
		$this->db->join('address', 'order.address_id = address.id', 'LEFT');
		$this->db->join('branch', 'order.restaurant_details = branch.id', 'LEFT');
		$this->db->join('customer', 'address.user_id = customer.id', 'LEFT');
        $this->db->where('order.status', '0');
		$this->db->order_by('order.id', 'desc');
        $query = $this->db->get();

		return $query->num_rows();

    }
	
	function getOrderData($id) {
        $this->db->select("order.id, order.price, order.name, order.mobile, order.email, order.delivery_details, branch.branch, address.city, address.location, address.company, address.flat, address.apartment, address.postcode, order.status");
        $this->db->from('orderdb.order');
		$this->db->join('address', 'order.address_id = address.id', 'LEFT');
		$this->db->join('branch', 'order.restaurant_details = branch.id', 'LEFT');
		$this->db->join('customer', 'address.user_id = customer.id', 'LEFT');
        $this->db->where('order.status', $id);
		$this->db->order_by('order.id', 'desc');
        $query = $this->db->get();
		
		$json_response = array();
		
		foreach ($query->result() as $row) {
			
			$row_array = array();
        	$row_array['id'] = $row->id;
			$row_array['price'] = $row->price;
			$row_array['name'] = $row->name;
			$row_array['mobile'] = $row->mobile;
			$row_array['email'] = $row->email;
			$row_array['delivery_details'] = $row->delivery_details;
			$row_array['branch'] = $row->branch;
			$row_array['city'] = $row->city;
			$row_array['location'] = $row->location;
			$row_array['company'] = $row->company;
			$row_array['flat'] = $row->flat;
			$row_array['apartment'] = $row->apartment;
			$row_array['postcode'] = $row->postcode;
			$row_array['status'] = $row->status;
        	$row_array['orders'] = array();
			
			$this->db->select("order_items.id, menu_items.name, order_items.item_options, order_items.price");
			$this->db->from('order_items');
			$this->db->join('menu_items', 'order_items.item_id = menu_items.id', 'LEFT');
			$this->db->where('order_id', $row->id);
			$this->db->order_by('menu_items.name', 'asc');
			$query2 = $this->db->get();
			
			foreach ($query2->result() as $row2) {
				$row_array['orders'][] = array(
				'id' => $row2->id,
                'name' => $row2->name,
                'quantity' => $row2->item_options,
                'price' => $row2->price,
            	);
			}
			array_push($json_response, $row_array);
		}
		
		return  $json_response;

        //return $query->result_array();
    }
	
	/*function getOrderItemData($id) {
        $this->db->select("order_items.id, menu_items.name, order_items.item_options, order_items.price");
        $this->db->from('order_items');
		$this->db->join('menu_items', 'order_items.item_id = menu_items.id', 'LEFT');
        $this->db->where('order_id', $id);
		$this->db->order_by('menu_items.name', 'asc');
        $query = $this->db->get();

        return $query->result_array();
    }*/
	
	function verifyEmail($email) {
        $this->db->select("email");
        $this->db->from("customer");
		$this->db->where('email', $email);
        $query = $this->db->get();

        return $query->num_rows();
    }
	
	function verifyMobile($mobile) {
        $this->db->select("mobile");
        $this->db->from("customer");
		$this->db->where('mobile', $mobile);
        $query = $this->db->get();

        return $query->num_rows();
    }


    function getData($table) {
        $this->db->select("*");
        $this->db->from($table);
        $query = $this->db->get();

        return $query->result_array();
    }

    function rawQuery($myquery) {

        $query = $this->db->query($myquery);

        return $query->result_array();
    }

    function addData($table, $data) {

        $this->db->insert($table, $data);

        //return $this->db->insert_id();
		
		return true;
    }
	
	function addDataInsert($table, $data) {

        $this->db->insert($table, $data);

        return $this->db->insert_id();
    }
	
	function addnotifyInsert($table, $data) {

        $this->db->insert($table, $data);

        return $this->db->insert_id();
    }

    function updateData($id, $data, $table) {
        $this->db->where("id", $id);
        $this->db->update($table, $data);

        return true;
    }
	
	function updateAddressData($id, $data, $table) {
        $this->db->where("user_id", $id);
        $this->db->update($table, $data);

        return true;
    }

    function deleteData($id, $table) {
        $this->db->where("id", $id);
        $this->db->delete($table);

        return true;
    }
	
	function deleteFavData($id, $table) {
        $this->db->where("menu_item_id", $id);
        $this->db->delete($table);

        return true;
    }
	
	function getReorderData($id) {
		
		$this->db->select("order.id, order.price, order.delivery_details, branch.id AS branch_id, branch.branch, order.status");
        $this->db->from('orderdb.order');
		$this->db->join('branch', 'order.restaurant_details = branch.id', 'LEFT');
        $this->db->where(array('order.status' => '2', 'order.customer_id' => $id));
		$this->db->order_by('order.id', 'desc');
        $query = $this->db->get();
		
		$json_response = array();
		
		foreach ($query->result() as $row) {
			
			$row_array = array();
        	$row_array['id'] = $row->id;
			$row_array['price'] = $row->price;
			$row_array['delivery_details'] = $row->delivery_details;
			$row_array['branch_id'] = $row->branch_id;
			$row_array['branch'] = $row->branch;
        	$row_array['orders'] = array();
			
			$this->db->select("order_items.id, menu_items.name, order_items.item_options, order_items.price");
			$this->db->from('order_items');
			$this->db->join('menu_items', 'order_items.item_id = menu_items.id', 'LEFT');
			$this->db->where('order_id', $row->id);
			$this->db->order_by('menu_items.name', 'asc');
			$query2 = $this->db->get();
			
			foreach ($query2->result() as $row2) {
				$row_array['orders'][] = array(
				'id' => $row2->id,
                'name' => $row2->name,
                'quantity' => $row2->item_options,
                'price' => $row2->price,
            	);
			}
			array_push($json_response, $row_array);
		}
		
		return  $json_response;
		
        /*$this->db->select("order_items.item_id, order_items.item_options, order_items.price");
        $this->db->from('order_items');
		$this->db->join('orderdb.order', 'order_items.order_id = order.id', 'LEFT');
        $this->db->where('order.customer_id', 1);
		$this->db->group_by('order.id');
        $query = $this->db->get();*/

        return $query->result_array();
    }
	
	function checkNameExists($table,$where,$param){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where($where, $param);
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count > 0){
            return $count ;
        } else {
            return $count ;
        }
    }
	
	function checkCatNameExists($table,$name,$menu){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where(array('name' => $name, 'menu_id' => $menu));
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count > 0){
            return $count ;
        } else {
            return $count ;
        }
    }

    function checkMenuExists($id,$table){
        $this->db->select("*");
        $this->db->from($table);
        $this->db->where('item_id', $id);
        $query = $this->db->get();
        $count = $query->num_rows();
        if($count > 0){
            return $count ;
        } else {
            return $count ;
        }

    }

	function getloginData($email, $password){

        $this->db->select("*");
        $this->db->from('customer');
        $this->db->where(array('email' => $email, 'password' => $password));
        $query = $this->db->get();
		$row = $query->result_array();

        return $row[0];

    }
	
	function getAddressById($id,$table){

        $this->db->select("*");
        $this->db->from($table);
        $this->db->where('user_id', $id);
        $query = $this->db->get();
			foreach ($query->result_array() as $row)
            {
                return $row['id'];
            }
    }
	
	function getAddressDetailsById($id,$table){

        $this->db->select("*, count(id) AS total");
        $this->db->from($table);
        $this->db->where('user_id', $id);
        $query = $this->db->get();
		$count = $query->num_rows();
        if($count > 0){
            return $query->result_array();
        } else {
            return array("count" => $count) ;
        }

        
    }
	
	function getFavouriteData($customer, $restaurant) {
        $this->db->select("*");
        $this->db->from('favourite_restaurant');
        $this->db->where(array('customer_id' => $customer, 'restaurant_id' => $restaurant));
        $query = $this->db->get();
		$count = $query->num_rows();

        return $count;
    }
	
	function getTotalTimes($customer, $menu) {
        $this->db->select("order_items.item_id, order.customer_id");
        $this->db->from('order_items');
		$this->db->join('orderdb.order', 'order_items.order_id = order.id', 'LEFT');
        $this->db->where(array('order_items.item_id' => 8, 'order.customer_id' => 4));
        $query = $this->db->get();
		$count = $query->num_rows();

        return $count;
    }


}
?>