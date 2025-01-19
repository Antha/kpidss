<?php

namespace App\Models;

use CodeIgniter\Model;

class Loyalty_model extends Model
{
    protected $db_con;

    protected $primaryKey = 'id';

    protected $allowedFields = ['product_name', 'product_point', 'product_stock', 'product_image'];

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
