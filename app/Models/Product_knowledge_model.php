<?php

namespace App\Models;

use CodeIgniter\Model;

class Product_knowledge_model extends Model
{
    protected $db_con;

    protected $primaryKey = 'id';

    protected $allowedFields = ['product_name', 'product_detail', 'product_image'];

    function __construct()
    {
        $this->db_con = db_connect('default');
    }

    // In your loyalty_model.php

    public function insertData($data)
    {
        // Check if the data is valid
        if (empty($data['product_name']) || empty($data['product_detail']) || empty($data['product_image']) ) {
            log_message('error', 'Data for insert is incomplete: ' . json_encode($data));
            return false;
        }

        // Prepare the SQL query
        $sql = "INSERT INTO product_knowledge (product_name, product_detail, product_image)
                VALUES (:product_name:, :product_detail:, :product_image:)";

        // Bind parameters
        $binds = [
            'product_name' => $data['product_name'],
            'product_detail' => $data['product_detail'],
            'product_image' => $data['product_image']
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
        $sql = "SELECT * FROM product_knowledge ORDER BY id desc";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function get_product_detail($product_id){
        $sql = "SELECT * FROM product_knowledge WHERE id = $product_id";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

}
