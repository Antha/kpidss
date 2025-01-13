<?php
namespace App\Models;

use CodeIgniter\Model;

class QuestionAnswerModel extends Model
{
    protected $table = 'quiz_answers';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'quiz_id', 'question_id', 'answer'];

    public function getMaxQuestionIdByUserId(int $userId, int $quizId): ?int
    {
        $query = $this->db->table($this->table)
                          ->selectMax('question_id', 'max_qid')
                          ->where('user_id', $userId)
                          ->where('quiz_id', $quizId)
                          ->get();

        $result = $query->getRow();

        // Return nilai max_qid jika ada hasil, jika tidak return null
        return $result ? (int) $result->max_qid + 1 : null;
    }


    public function getAnswersByUserId(int $userId, int $quizId): array
    {
        // Build the query to select question_id and answer for the given user_id
        $query = $this->db->table($this->table)
                          ->select('question_id, answer')
                          ->where('user_id', $userId)
                          ->where('quiz_id', $quizId)
                          ->get();

        // Return the result as an array
        return $query->getResultArray();
    }
}

?>