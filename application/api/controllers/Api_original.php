<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {



    function restaurant_get()
    {

        $this->load->model( 'Data_model');
        //if($this->get('location') && $this->get('area') || $this->get('zip')) {
           // $data = $this->Data_model->getByLocation();
        $data = $this->Data_model->getRestaurant();
        //}

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

        $this->load->model( 'Data_model');
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

    function restaurant_put()
    {

        $this->load->model( 'Data_model');
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

    function restaurant_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

    function branch_get()
    {


            $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function branch_put()
    {

        $this->load->model( 'Data_model');
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


    function branch_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function menuId_put()
    {

        $this->load->model( 'Data_model');
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


    function menuId_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function accountDetails_put()
    {

        $this->load->model( 'Data_model');
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


    function accountDetails_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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



    function category_get()
    {

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('menu_category', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function category_put()
    {

        $this->load->model( 'Data_model');
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


    function category_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('menu_items', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function menuItems_put()
    {

        $this->load->model( 'Data_model');
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


    function menuItems_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

    $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function menuGroup_put()
    {

        $this->load->model( 'Data_model');
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


    function menuGroup_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

        $this->load->model( 'Data_model');
        $data = $this->Data_model->getData('ingredient_group');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function ingredientGroup_post()
    {

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('ingredient_group', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function ingredientGroup_put()
    {

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'ingredient_group');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function ingredientGroup_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
        $data = $this->Data_model->deleteData($id, 'ingredient_group');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function ingredient_get()
    {

        $this->load->model( 'Data_model');
        $data = $this->Data_model->getData('ingredient');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function ingredient_post()
    {

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('ingredient', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function ingredient_put()
    {

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'ingredient');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function ingredient_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
        $data = $this->Data_model->deleteData($id, 'ingredient');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }












    function users_get()
    {

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function users_put()
    {

        $this->load->model( 'Data_model');
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


    function users_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function transaction_put()
    {

        $this->load->model( 'Data_model');
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


    function transaction_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function customer_put()
    {

        $this->load->model( 'Data_model');
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


    function customer_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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


    function favourite_restaurant_get()
    {

        $this->load->model( 'Data_model');
        $data = $this->Data_model->getData('favourite_restaurant');
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

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('favourite_restaurant', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function favourite_restaurant_put()
    {

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'favourite_restaurant');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function favourite_restaurant_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
        $data = $this->Data_model->deleteData($id, 'favourite_restaurant');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function favourite_items_get()
    {

        $this->load->model( 'Data_model');
        $data = $this->Data_model->getData('favourite_items');
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function favourite_items_post()
    {

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('favourite_items', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function favourite_items_put()
    {

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $id = $this->post('id');
        $data = $this->Data_model->updateData($id, $params, 'favourite_items');

        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }


    function favourite_items_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
        $data = $this->Data_model->deleteData($id, 'favourite_items');
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

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function paymentDetails_put()
    {

        $this->load->model( 'Data_model');
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


    function paymentDetails_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function address_put()
    {

        $this->load->model( 'Data_model');
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


    function address_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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



    function order_get()
    {

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
        $params = json_decode($this->post('data'), true);
        $data = $this->Data_model->addData('order', $params);
        if($data)
        {
            $this->response($data, 200);
        }
        else
        {
            $this->response(NULL, 404);
        }
    }

    function order_put()
    {

        $this->load->model( 'Data_model');
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


    function order_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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




    function orderItems_get()
    {

        $this->load->model( 'Data_model');
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

        $this->load->model( 'Data_model');
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

    function orderItems_put()
    {

        $this->load->model( 'Data_model');
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


    function orderItems_delete()
    {

        $this->load->model( 'Data_model');
        $id = $this->delete('id');
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


}

?>