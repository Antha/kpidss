<?php
namespace App\Models;

use CodeIgniter\Model;

class UserQuizModel extends Model
{
    protected $table = 'user_quizess';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'photo', 'status', 'long', 'lat', 'datetime','datetime_fake'];

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
                    MIN(DATEDIFF(CURDATE(), `datetime_fake`)) AS days_difference,
                    DATE_ADD(MIN(DATETIME), INTERVAL 1 MONTH) AS datetime_plus_1_month
                FROM 
                    `user_quizess`
                WHERE 
                    user_id = ".$userId." AND STATUS = 'finished' AND DATETIME =
                    (SELECT MAX(DATETIME) FROM user_quizess WHERE user_id = ".$userId.")
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
                    ROUND((100/(ss.num_right + ss.num_wrong)),0) * ss.num_right AS score, 
                    uq.status,
                    periode
                    FROM
                    (

                    SELECT
                        user_id, quiz_id,created_at,periode,
                        SUM(is_right) AS num_right,   
                        SUM(is_wrong) AS num_wrong
                    FROM
                    (
                        SELECT 
                        qa.user_id, 
                        qa.quiz_id, 
                        qa.question_id, 
                        qa.answer,
                        qa.created_at, 
                        q.correct_option,
                        CONCAT('PNP TEST#',q.periode) periode,
                        CASE WHEN qa.answer = q.correct_option THEN 1 ELSE 0 END AS is_right,
                        CASE WHEN qa.answer != q.correct_option THEN 1 ELSE 0 END AS is_wrong
                        FROM 
                        `quiz_answers` qa 
                        JOIN `questions` q ON qa.question_id = q.id 
                    
                    ) AS quiz_data
                    GROUP BY user_id, quiz_id
                    ) AS ss 
                                JOIN `users` u ON ss.user_id = u.id
                                JOIN `user_quizess` uq ON ss.quiz_id = uq.id
                                WHERE DATE_FORMAT(created_at,'%Y%m') = '$periode' $where_var
                                ORDER BY score DESC
        ");

        writeLogTofile($db->getLastQuery());

        return $query->getResultArray();
    }

    public function getSummaryPNPLombok()
    {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT
                    u.agent_id AS `Agent ID`,
                    u.id user_id, 
                    u.`digipos_id` `Digipos ID`,
                    u.`dss_name` `DSS Name`,
                    u.`branch` `branch`,
                    u.`cluster` `cluster`,
                    u.`city` `city`,
                    u.`role` `role`, 
                    uq.datetime,
                    uq.photo,
                    ss.quiz_id quiz_id, 
                    ss.num_right,
                    ss.num_wrong,
                    ROUND((100/(ss.num_right + ss.num_wrong)),0) * ss.num_right AS score, 
                    uq.status,
                    periode
                    FROM
                    (

                    SELECT
                        user_id, quiz_id,created_at,periode,
                        SUM(is_right) AS num_right,   
                        SUM(is_wrong) AS num_wrong
                    FROM
                    (
                        SELECT 
                        qa.user_id, 
                        qa.quiz_id, 
                        qa.question_id, 
                        qa.answer,
                        qa.created_at, 
                        q.correct_option,
                        CONCAT('PNP TEST#',q.periode) periode,
                        CASE WHEN qa.answer = q.correct_option THEN 1 ELSE 0 END AS is_right,
                        CASE WHEN qa.answer != q.correct_option THEN 1 ELSE 0 END AS is_wrong
                        FROM 
                        `quiz_answers` qa 
                        JOIN `questions` q ON qa.question_id = q.id
                        WHERE DATE_FORMAT(created_at,'%Y%m') = '202510' AND q.type = 'LMBK' 
                    ) AS quiz_data
                    GROUP BY user_id, quiz_id
                    ) AS ss 
                                JOIN `users` u ON ss.user_id = u.id
                                JOIN `user_quizess` uq ON ss.quiz_id = uq.id
                                ORDER BY score DESC");

        writeLogTofile($db->getLastQuery());

        return $query->getResultArray();
    }

    public function getHighestRightQuestion()
    {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT
                    quiz_no,
                    (SUM(is_right) / (SUM(is_right) + SUM(is_wrong))) * 100 AS percentage
                FROM (
                    SELECT 
                        qa.user_id, qa.question_id, q.no quiz_no,
                        CASE WHEN qa.answer = q.correct_option THEN 1 ELSE 0 END AS is_right,
                        CASE WHEN qa.answer != q.correct_option THEN 1 ELSE 0 END AS is_wrong
                    FROM quiz_answers qa
                    JOIN questions q ON qa.question_id = q.id
                    WHERE q.type = 'LMBK'
                ) AS quiz_data
                GROUP BY quiz_no
                ORDER BY percentage DESC
                LIMIT 1");

        return $query->getResultArray();
    }

    public function getLowestRightQuestion()
    {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT
                    quiz_no,
                    (SUM(is_right) / (SUM(is_right) + SUM(is_wrong))) * 100 AS percentage
                FROM (
                    SELECT 
                        qa.user_id, qa.question_id, q.no quiz_no,
                        CASE WHEN qa.answer = q.correct_option THEN 1 ELSE 0 END AS is_right,
                        CASE WHEN qa.answer != q.correct_option THEN 1 ELSE 0 END AS is_wrong
                    FROM quiz_answers qa
                    JOIN questions q ON qa.question_id = q.id
                    WHERE q.type = 'LMBK'
                ) AS quiz_data
                GROUP BY quiz_no
                ORDER BY percentage ASC
                LIMIT 1");

        return $query->getResultArray();
    }

    public function getQuestionScore()
    {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT
                    `no` quiz_no,
                    SUM(is_right) AS num_right,   
                    SUM(is_wrong) AS num_wrong,
                    (SUM(is_right)/(SUM(is_right)+SUM(is_wrong)))*100 percentage
                    FROM
                    (
                    SELECT 
                    qa.user_id, 
                    qa.quiz_id, 
                    qa.question_id,
                    q.no, 
                    qa.answer,
                    qa.created_at, 
                    q.correct_option,
                    CONCAT('PNP TEST#',q.periode) periode,
                    CASE WHEN qa.answer = q.correct_option THEN 1 ELSE 0 END AS is_right,
                    CASE WHEN qa.answer != q.correct_option THEN 1 ELSE 0 END AS is_wrong
                    FROM 
                    `quiz_answers` qa 
                    JOIN `questions` q ON qa.question_id = q.id
                    WHERE q.periode = '7' AND `type` = 'DS'
                    
                    ) AS quiz_data
                    GROUP BY quiz_no
                    ORDER BY quiz_no");

        return $query->getResultArray();
    }
    
    public function getScoreDetail($quiz_id)
    {
        $db = \Config\Database::connect();

        $query = $db->query("SELECT 
				qa.created_at, 
				qa.user_id, 
				qa.quiz_id,
				q.no, 
				qa.question_id, 
				qa.answer,
				q.correct_option,
				CASE WHEN qa.answer = q.correct_option THEN 'Benar' ELSE 'Salah' END AS Statement
				FROM 
				quiz_answers qa 
				JOIN questions q ON qa.question_id = q.id 
				WHERE quiz_id = $quiz_id");

        writeLogTofile($db->getLastQuery());

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
