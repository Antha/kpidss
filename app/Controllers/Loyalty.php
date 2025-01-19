<?php

namespace App\Controllers;

use App\Models\Loyalty_model;
use CodeIgniter\Controller;

use App\Models\QuestionModel;
use App\Models\QuestionAnswerModel;
use App\Models\LoyaltyModel;

class Loyalty extends Controller
{
    protected $loyalty_model;

    function __construct()
    {
        $this->loyalty_model = new Loyalty_model();
    }

    public function index()
    {
        //dummy data for query result of calculating user point
        $query_result_user_point = 300;

        //display user point
        $data['display_user_point'] = $query_result_user_point;

        $data['display_all_product'] = $this->loyalty_model->display_all_product();

        return view('loyalty_page',$data);
    }

    function cek_redeem_point(){
        //dummy data for query result of calculating user point
        $query_result_user_point = 3000;

        //get product id
        $product_id = $_POST['product_id'];

        //run query for getting product poin
        $get_product_point = $this->loyalty_model->get_product_point($product_id);

        if($query_result_user_point > $get_product_point[0]['product_point'])
        {
            if($get_product_point[0]['product_point'] == 0){
                echo "empty stock";
            }else{
                $parse_value = array('parse_product_point' => $get_product_point[0]['product_point'], 'parse_product_name' => $get_product_point[0]['product_name']);
                echo json_encode($parse_value);
            }
        }else{
            echo "not enough point";
        }
    }

    function redeem_process(){
        $product_id = $_POST['product_id'];
        $product_point = $_POST['product_point'];
        
        $this->loyalty_model->redeem_process_product($product_id);

        //belum dengan dikurangi user-point - product-point

        echo "success";
    }
}
