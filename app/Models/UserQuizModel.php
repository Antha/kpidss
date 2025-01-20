<?php
namespace App\Models;

use CodeIgniter\Model;

class UserQuizModel extends Model
{
    protected $table = 'user_quizess';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'photo', 'status', 'long', 'lat', 'datetime'];

    // Fungsi untuk mendapatkan data dengan status 'UNFINISHED'
    // Fungsi untuk mendapatkan data berdasarkan status dan user_id
    public function getUnfinishedQuizzesByUser($userId)
    {
        return $this->select('id, user_id, photo, long, lat')
                    ->where('status', 'UNFINISHED')
                    ->where('user_id', $userId)
                    ->first();
    }

    public function getLastUpdateData()
    {
        return $this->selectMax('datetime')->first();
    }

    function isDataExists($periode){
        $db = \Config\Database::connect();

        $query = $db->query("SELECT datetime FROM user_quizess WHERE datetime LIKE '$periode%' LIMIT 1");

        return $query->getNumRows();
    }

    public function replaceData(array $data)
    {
        $query = "
            REPLACE INTO {$this->table} (id, user_id, photo, `long`, `lat`, status, datetime)
            VALUES (:id:, :user_id:, :photo:, :long:, :lat:, :status:, :datetime:)
        ";

        return $this->db->query($query, $data);
    }

    public function insertAndGetId(array $data): int
    {
        $this->insert($data);
        return $this->insertID();
    }

    public function getSummaryPNP($periode)
    {
        $db = \Config\Database::connect();

        $query = $db->query("
             SELECT
                u.agent_id AS `Agent ID`, 
                u.`digipos_id` `Digipos ID`,
                u.`dss_name` `DSS Name`, 
                uq.datetime, 
                ss.num_right,
                ss.num_wrong,
                ss.num_right * 10 AS score, 
                uq.status
            FROM
            (
                SELECT
                    user_id, quiz_id, 
                    SUM(is_right) AS num_right,   
                    SUM(is_wrong) AS num_wrong
                FROM
                (
                    SELECT 
                        qa.user_id, 
                        qa.quiz_id, 
                        qa.question_id, 
                        qa.answer, 
                        q.correct_option,
                        CASE WHEN qa.answer = q.correct_option THEN 1 ELSE 0 END AS is_right,
                        CASE WHEN qa.answer != q.correct_option THEN 1 ELSE 0 END AS is_wrong
                    FROM 
                        `quiz_answers` qa 
                    JOIN `questions` q ON qa.question_id = q.id 
                    WHERE DATE_FORMAT(created_at,'%Y%m') = '$periode'
                ) AS quiz_data
                GROUP BY user_id, quiz_id
            ) AS ss 
            JOIN `users` u ON ss.user_id = u.id
            JOIN `user_quizess` uq ON ss.quiz_id = uq.id
        ");

        return $query->getResultArray();
    }

    public function getSummaryPNP_old()
    {
        $db = \Config\Database::connect();

        $query = $db->query("
             SELECT
                kd.agent_id AS `Agent ID`, 
                kd.`digipos_id` `Digipos ID`,
                kd.`dss_name` `DSS Name`, 
                uq.datetime, 
                ss.num_right,
                ss.num_wrong,
                ss.num_right * 10 AS score, 
                uq.status
            FROM
            (
                SELECT
                    user_id, quiz_id, 
                    SUM(is_right) AS num_right,   
                    SUM(is_wrong) AS num_wrong
                FROM
                (
                    SELECT 
                        qa.user_id, 
                        qa.quiz_id, 
                        qa.question_id, 
                        qa.answer, 
                        q.correct_option,
                        CASE WHEN qa.answer = q.correct_option THEN 1 ELSE 0 END AS is_right,
                        CASE WHEN qa.answer != q.correct_option THEN 1 ELSE 0 END AS is_wrong
                    FROM 
                        `quiz_answers` qa 
                    JOIN `questions` q ON qa.question_id = q.id
                ) AS quiz_data
                GROUP BY user_id, quiz_id
            ) AS ss 
            JOIN `users` u ON ss.user_id = u.id
            JOIN `kpi_data` kd ON u.agent_id = kd.agent_id
            JOIN `user_quizess` uq ON ss.quiz_id = uq.id
        ");

        return $query->getResultArray();
    }
}
?>
