<?php

namespace App\Models;

use CodeIgniter\Model;

class Kpi_model extends Model
{
    protected $db_con;

    function __construct()
    {
        $this->db_con = db_connect('default');
    }

    function get_latest_table_kpi(){
        $sql = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES 
				WHERE TABLE_NAME LIKE 'kpi_data_%' AND DATA_LENGTH != 0 
				ORDER BY TABLE_NAME DESC LIMIT 1";
					
		$query = $this->db_con->query($sql);

        $result = $query->getResultArray();
        $table_name = $result[0]['TABLE_NAME'];

		return $table_name;
    }

   

    function get_lastupdate_date(){
        $sql = "SELECT MAX(periode) last_update_date FROM kpi_data";
					
		$query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function cek_data_kpi_exists($periode){
        $sql = "SELECT agent_id FROM kpi_data WHERE periode LIKE $periode LIMIT 1";
					
		$query = $this->db_con->query($sql);

        $result = $query->getNumRows();
			
		return $result;
    }

    function get_kpi_data_v2($periode){
        $sql = "SELECT * FROM kpi_data_$periode";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function get_kpi_data($periode,$where_var){
        $sql = "SELECT * FROM kpi_data WHERE periode LIKE $periode $where_var";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }

    function get_kpi_lb_branch($periode,$branch){
        $sql = "SELECT * FROM kpi_lb WHERE periode LIKE $periode AND branch = '".$branch."'";

        $query = $this->db_con->query($sql);

        if($query){
            return $query->getResultArray();
        }else{
            return $this->db_con->error();
        }
    }
}
