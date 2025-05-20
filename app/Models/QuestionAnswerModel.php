<?php
namespace App\Models;

use CodeIgniter\Model;

class QuestionAnswerModel extends Model
{
    protected $table = 'quiz_answers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'quiz_id', 'question_id', 'answer'];

    public function getMaxQuestionIdByUserId(int $userId, int $quizId)
    {
        $sql = "
                SELECT 
                    * 
                FROM 
                    (
                        SELECT 
                            question_id, 
                            question_id AS max_qid 
                        FROM 
                            `quiz_answers` 
                        WHERE 
                            user_id = ? 
                            AND quiz_id = ? 
                        ORDER BY 
                            question_id DESC 
                        LIMIT 1
                    ) AS qa
                JOIN 
                    `questions` q 
                ON 
                    qa.question_id = q.id
                ";
        
        $query = $this->db->query($sql, [$userId, $quizId]);

        writeLogToFile( $this->db->getLastQuery() );

        $result = $query->getRow();
        // Return nilai max_qid jika ada hasil, jika tidak return null
        return $result;
    }


    public function getAnswersByUserId(int $userId, int $quizId): array
    {
        $query = $this->db->query("
            SELECT * FROM (
                SELECT 
                    qa.user_id, 
                    qa.quiz_id, 
                    qa.question_id, 
                    qa.answer, 
                    q.correct_option,
                    q.no question_no,
                    q.periode,
                    CASE WHEN qa.answer = q.correct_option THEN 1 ELSE 0 END AS is_right,
                    CASE WHEN qa.answer != q.correct_option THEN 1 ELSE 0 END AS is_wrong
                FROM 
                    `quiz_answers` qa 
                JOIN `questions` q ON qa.question_id = q.id
                WHERE qa.user_id = ? AND qa.quiz_id = ?
            ) AS subquery
        ", [$userId, $quizId]);
 
        return $query->getResultArray();
    }
    
}

?>