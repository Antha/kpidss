<?php

namespace App\Models;

use CodeIgniter\Model;

class Loyalty_model extends Model
{
    protected $db_con;

    function __construct()
    {
        $this->db_con = db_connect('default');
    }

    function display_all_product(){
        $sql = "SELECT * FROM product_redeem WHERE product_stock > 0";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function get_product_point($product_id){
        $id = $this->db_con->escape($product_id);
        $sql = "SELECT product_point,product_name,product_stock FROM product_redeem WHERE id = $id";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function redeem_process_product($product_id){
        $id = $this->db_con->escape($product_id);
        $sql = "UPDATE product_redeem SET product_stock = product_stock -1 WHERE id = $id";

        $this->db_con->query($sql);
    }


}
