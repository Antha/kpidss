<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLogoutTrigger extends Migration
{
    public function up()
    {
        $sql = "
            CREATE EVENT auto_logout_users
            ON SCHEDULE EVERY 1 MINUTE
            DO
            BEGIN
                UPDATE users
                SET session_id = NULL
                WHERE last_login_time <= NOW() - INTERVAL 5 MINUTE;
            END;
        ";

        $this->db->query($sql);
    }

    public function down()
    {
        $sql = "DROP EVENT IF EXISTS auto_logout_users;";
        $this->db->query($sql);
    }
}
