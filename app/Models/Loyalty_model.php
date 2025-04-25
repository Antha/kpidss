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
            return $this->db_con->error();
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

    function getMaxPeriodePoint($user_id){
        $sql = "SELECT MAX(periode) AS ym
                FROM users_points
                WHERE user_id = ?";

        $query = $this->db_con->query($sql, [$user_id]);

        if($query){
            return $query->getRowArray();
        }else{
            return $this->db_con->error();
        }
    }

    function getDetailPointMonth($user_id,$yPeriode){
        $sql = "SELECT 
                CASE WHEN SUBSTRING(periode,5,6) = '01' THEN 'JAN' 
                WHEN SUBSTRING(periode,5,6) = '02' THEN 'FEB'
                WHEN SUBSTRING(periode,5,6) = '03' THEN 'MAR'
                WHEN SUBSTRING(periode,5,6) = '04' THEN 'APR'
                WHEN SUBSTRING(periode,5,6) = '05' THEN 'MAY'
                WHEN SUBSTRING(periode,5,6) = '06' THEN 'JUN'
                WHEN SUBSTRING(periode,5,6) = '07' THEN 'JUL'
                WHEN SUBSTRING(periode,5,6) = '08' THEN 'AUG'
                WHEN SUBSTRING(periode,5,6) = '09' THEN 'SEP'
                WHEN SUBSTRING(periode,5,6) = '10' THEN 'OCT'
                WHEN SUBSTRING(periode,5,6) = '11' THEN 'NOV'
                WHEN SUBSTRING(periode,5,6) = '12' THEN 'DEC'
                END AS bulan,
                SUM(POINT) AS total_point
            FROM 
                users_points
            WHERE 
                user_id = ?
                AND periode LIKE ?
                AND point_category = 'Quiz'
            GROUP BY 
                periode
            ORDER BY 
                periode";

         $query = $this->db_con->query($sql, [$user_id, $yPeriode . '%']);

         if ($query) {
             return $query->getResultArray();
         } else {
             return $this->db_con->error();
         }
    }

    function getDetailPointBatch($user_id,$yPeriode){
        $sql = "SELECT 
                batch,
                SUM(POINT) AS total_point
            FROM 
                users_points
            WHERE 
                user_id = ?
                AND periode LIKE ?
                AND point_category = 'Quiz'
            GROUP BY 
                batch
            ORDER BY 
                batch ASC";

         $query = $this->db_con->query($sql, [$user_id, $yPeriode . '%']);

         if ($query) {
             return $query->getResultArray();
         } else {
             return $this->db_con->error();
         }
    }
    
    function getDetailPoint($yPeriode, $user_id)
    {
        $sql = "
            SELECT 
                DATE_FORMAT(STR_TO_DATE(periode, '%Y%m'), '%b') AS month,
                SUM(point) AS total_point
            FROM 
                users_points
            WHERE 
                user_id = ?
                AND periode LIKE ?
            GROUP BY 
                month
            ORDER BY 
                periode
        ";

        $query = $this->db_con->query($sql, [$user_id, $yPeriode . '%']);

        if ($query) {
            return $query->getResultArray();
        } else {
            return $this->db_con->error();
        }
    }


    function getPointOld($user_id){
        $sql = "SELECT
            point.num - ifnull(redeem.num,0) AS point_now
            FROM
            (
                SELECT 
                SUM(`point`) `num`
                FROM `users_points` 
                WHERE user_id = $user_id AND periode >= (SELECT DATE_FORMAT(DATE_SUB(NOW(),INTERVAL 3 MONTH),'%Y%m')
                FROM users_points LIMIT 1)
            ) `point`
            JOIN
            (
                SELECT
                SUM(redeem) `num` FROM `users_redeem` WHERE user_id = $user_id
            ) AS `redeem`
            ";
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
                FROM `users_points` 
                WHERE (user_id = $user_id AND LOWER(point_category) = 'quiz' AND batch >= '2') OR (user_id = $user_id AND LOWER(point_category) = 'kpi' AND periode > '202412')
            ) `point`
            JOIN
            (
                SELECT
                SUM(redeem) `num` FROM `users_redeem` WHERE user_id = $user_id
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
        $sql = "SELECT product_point,product_name,product_stock,product_image FROM product_redeem WHERE id = $id";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function redeem_process_product($product_id,$user_id,$redeem,$status){
        $id = $this->db_con->escape($product_id);
        $sql = "UPDATE product_redeem SET product_stock = product_stock - 1 WHERE id = $id";
        $this->db_con->query($sql);

        $sql = "INSERT INTO users_redeem(user_id,product_id,redeem,`status`) values ($user_id,$id,$redeem,$status) ";
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

    function edit_product_detail($data) {
        //--
        $session = session();
    
        // Escape all input data
        $product_id = $this->db_con->escape($data["product_id"]);
        $product_name = $this->db_con->escape($data["product_name"]);
        $product_stock = $this->db_con->escape($data["product_stock"]);
        $product_point = $this->db_con->escape($data["product_point"]);
        $admin_id = $session->get("user_id");
    
        // Buat array untuk menyimpan bagian SET dari query
        $update_fields = [
            "product_stock = $product_stock",
            "product_name = $product_name",
            "product_point = $product_point"
        ];
    
        // Periksa apakah index product_image ada dalam data
        if (isset($data["product_image"])) {
            $product_image = $this->db_con->escape($data["product_image"]);
            $update_fields[] = "product_image = $product_image";
        }
    
        // Gabungkan bagian SET menjadi satu string
        $update_query = implode(", ", $update_fields);
    
        // Update product_redeem table
        $sql = "UPDATE product_redeem 
                SET $update_query
                WHERE id = $product_id";
    
        writeLogToFile("edt : " . $sql);
    
        if ($this->db_con->query($sql)) {
            // Log the changes in product_redeem_edit_history table
            $sql_insert = "INSERT INTO product_redeem_edit_history(product_id, product_name, quantity, admin_id) 
                        VALUES ($product_id, $product_name, $product_stock, $admin_id)";
    
            writeLogToFile("edt : " . $sql_insert);
    
            if (!$this->db_con->query($sql_insert)) {
                // Handle logging failure
                writeLogToFile("Failed to insert into edit history: " . $this->db_con->error);
            }
        } else {
            // Handle update failure
            writeLogToFile("Failed to update product_redeem: " . $this->db_con->error);
        }
    
        return true;
    }
    

    function delete_product($product_id){
        $product_id = $this->db_con->escape($product_id);
        $sql = "DELETE FROM product_redeem WHERE id = $product_id";
        $this->db_con->query($sql);
    }

    function get_redeem_list(){
       
        $sql = "SELECT username,dss_name,branch,cluster,city,user_id,product_name, redeem_point, redeem_time, status_product
                FROM
                (SELECT user_id,product_id,redeem AS redeem_point,`datetime` AS redeem_time, 'BELUM DITERIMA' status_product
                FROM `users_redeem` WHERE `status` = 'NA')A
                JOIN
                (SELECT id,username,dss_name,branch,cluster,city
                FROM `users`)B
                ON A.user_id = B.id
                JOIN
                (SELECT id,product_name
                FROM `product_redeem`)C
                ON A.product_id = C.id";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function cek_status_redeem($user_id,$product_id){
        $sql = "SELECT 
                CASE 
                    WHEN CURRENT_DATE > dt_max + INTERVAL 6 MONTH 
                    THEN 'A' 
                    ELSE 'NA' 
                END AS status_available
                FROM (
                SELECT MAX(`datetime`) AS dt_max 
                FROM `users_redeem` 
                WHERE user_id = '$user_id' AND product_id = '$product_id'
                ) AS t";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getRowArray();
        }else{
            return $this->db_con->error();
        }
    }
}
