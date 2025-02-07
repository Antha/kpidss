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

    public function getRecentFinishedQuiz($userId)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $query = $db->query("
            SELECT *
            FROM (
                SELECT 
                    user_id,
                    MIN(DATEDIFF(CURDATE(), `datetime`)) AS days_difference,
                    DATE_ADD(min(datetime), INTERVAL 1 MONTH) as datetime_plus_1_month
                FROM 
                    `user_quizess`
                WHERE 
                    user_id = ? AND status = 'finished'
            ) AS DATA
            WHERE days_difference < 30
        ", [$userId]);

        return $query->getRowArray(); // Mengembalikan satu baris data sebagai array
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

    public function getSummaryPNP($periode,$where_var)
    {
        $db = \Config\Database::connect();

        $query = $db->query("
             SELECT
                u.agent_id AS `Agent ID`, 
                u.`digipos_id` `Digipos ID`,
                u.`dss_name` `DSS Name`,
                u.`branch` `branch`,
                u.`cluster` `cluster`,
                u.`city` `city`,
                u.`role` `role`, 
                uq.datetime,
                uq.photo, 
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
            $where_var
            ORDER BY score DESC
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
            ORDER BY score DESC
        ");

        return $query->getResultArray();
    }

    function getDsLoginReport(){
        $db = \Config\Database::connect();

        $query = $db->query("SELECT A.total_user user_login, B.total_user - A.total_user user_belum_login
                            FROM
                            (SELECT 'total' total, IFNULL(COUNT(DISTINCT id_user),0) total_user
                            FROM `user_histories` sub_a
                            JOIN users sub_b
                            ON sub_a.id_user = sub_b.id
                            WHERE sub_b.`level` NOT IN('admin','admin_cms')) A 
                            JOIN
                            (SELECT 'total' total,IFNULL(COUNT(DISTINCT id),0) total_user FROM users WHERE `level` NOT IN('admin','admin_cms'))B
                            ON A.total = B.total");

        $isDataExsits = $query->getNumRows();

        if($isDataExsits >= 1){
            $result = $query->getResultArray();
        }else{
            $result = 0;
        }

        return $result;
    }
}
?>
