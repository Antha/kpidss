<?php
namespace App\Models;

use CodeIgniter\Model;

class UserQuizTimerModel extends Model
{
    protected $table = 'user_quizess_time';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['user_id', 'remaintime'];

    // public function replaceRemainingTime(int $userId, int $remaintime): bool
    // {
    //     $sql = "REPLACE INTO {$this->table} (user_id, remaintime) VALUES (:user_id:, :remaintime:)";
    //     return $this->db->query($sql, [
    //         'user_id' => $userId,
    //         'remaintime' => $remaintime,
    //     ]);
    // }

    public function updateRemainingTime(int $userId, int $remainingSeconds): bool
    {
        // Query manual
        $sql = "UPDATE user_quizess_time SET remaintime = ? WHERE user_id = ?";
        $result = $this->db->query($sql, [$remainingSeconds, $userId]);

        // Return true jika query berhasil dijalankan
        return $result ? true : false;
    }

    public function deleteByUserId(int $userId): bool
    {
        // Query manual untuk menghapus data
        $sql = "DELETE FROM {$this->table} WHERE user_id = ?";
        $result = $this->db->query($sql, [$userId]);

        // Return true jika query berhasil dijalankan
        return $result ? true : false;
    }
}
?>
