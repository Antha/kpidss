<?php

namespace App\Models;

use CodeIgniter\Model;

class Loyalty_model extends Model
{
    protected $db_con;

    protected $primaryKey = 'id';

    protected $allowedFields = ['product_name', 'product_point', 'product_stock', 'product_image','product_main_image'];

    function __construct()
    {
        $this->db_con = db_connect('default');
    }

    // In your loyalty_model.php

    public function insertData($data)
    {
        // Check if the data is valid
        if (empty($data['product_name']) || empty($data['product_point']) || empty($data['product_stock']) || empty($data['product_image'])) {
            log_message('error', 'Data for insert is incomplete: ' . json_encode($data));
            return false;
        }

        // Prepare the SQL query
        $sql = "INSERT INTO product_redeem (product_name, product_point, product_stock, product_image)
                VALUES (:product_name:, :product_point:, :product_stock:, :product_image:)";

        // Bind parameters
        $binds = [
            'product_name' => $data['product_name'],
            'product_point' => $data['product_point'],
            'product_stock' => $data['product_stock'],
            'product_image' => $data['product_image'],
        ];

        // Execute the raw query
        try {
            $this->db_con->query($sql, $binds);
            return true;
        } catch (\Exception $e) {
            log_message('error', 'Database error while inserting data: ' . $e->getMessage());
            return false;
        }
    }


    function display_all_product(){
        $sql = "SELECT * FROM product_redeem WHERE product_stock > 0 order by id desc";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function display_all_product_with_zero_value(){
        $sql = "SELECT * FROM product_redeem order by product_name desc";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function getPoint($user_id){
        $sql = "SELECT
            point.num - ifnull(redeem.num,0) AS point_now
            FROM
            (
                SELECT 
                SUM(`point`) `num`
                FROM `users_points` WHERE user_id = $user_id AND periode >= ( SELECT DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 3 MONTH),\"%Y%m\") FROM DUAL )
            ) `point`
            JOIN
            (
                SELECT
                SUM(redeem) `num` FROM `users_redeem` WHERE user_id = 3
            ) AS `redeem`
            ";
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

    function redeem_process_product($product_id,$user_id,$redeem){
        $id = $this->db_con->escape($product_id);
        $sql = "UPDATE product_redeem SET product_stock = product_stock - 1 WHERE id = $id";
        $this->db_con->query($sql);

        $sql = "INSERT INTO users_redeem(user_id,product_id,redeem) values ($user_id,$id,$redeem) ";
        $this->db_con->query($sql);
    }

    // Fetch product details where user_id = 6
    public function getProductRedeemsByUser($user_id)
    {
        $query = "
            SELECT 
                pr.*, ur.id id_redeem,ur.datetime date_redeem, ur.status status
            FROM 
                users_redeem ur 
            JOIN
                product_redeem pr
            ON 
                ur.product_id = pr.id
            WHERE 
                ur.user_id = ? AND status IN('A','NA')
        ";

        // Execute the raw query and pass the user_id as a parameter
        return $this->db_con->query($query, [$user_id])->getResult();
    }

    function add_stock_product_redeem_history($product_id,$product_name,$product_stock,$admin_id){
        $id = $this->db_con->escape($product_id);
        $sql = "INSERT INTO product_redeem_stock_history(product_id,quantity,admin_id) values ($product_id,$product_stock,$admin_id) ";
        $this->db_con->query($sql);
    }

    function update_redeem_status($redeem_id){
        $id = $this->db_con->escape($redeem_id);
        $sql = " UPDATE users_redeem SET status = 'A' where id = $id ";
        $this->db_con->query($sql);
    }

    function edit_product_detail($product_id,$product_name,$product_stock,$product_point,$admin_id){
        $product_name = $this->db_con->escape($product_name);
        $sql = "UPDATE product_redeem SET product_stock = $product_stock, product_name = $product_name, product_point = $product_point WHERE id = $product_id";
        $this->db_con->query($sql);

        $sql_insert = "INSERT INTO product_redeem_edit_history(product_id,product_name,quantity,admin_id) VALUES ($product_id,$product_name,$product_stock,$admin_id)";
        $this->db_con->query($sql_insert);
    }

    function delete_product($product_id){
        $product_id = $this->db_con->escape($product_id);
        $sql = "DELETE FROM product_redeem WHERE id = $product_id";
        $this->db_con->query($sql);
    }
}
