<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $allowedFields = ['no','question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option','status'];
    
    // Ambil pertanyaan berdasarkan nomor urut
    public function getQuestionByNumber($number)
    {
        return $this->asArray()
            ->where('id', $number)
            ->first();
    }

    // Ambil pertanyaan berdasarkan nomor urut
    public function get_min_id_on_status() {
        $this->selectMin('id'); // selectMin untuk memilih nilai minimum
        $this->where('status', 'On');
        $result = $this->first(); // Mengambil satu hasil pertama (karena ini adalah nilai minimum)

        return $result ? $result['id'] : null; // Mengembalikan id atau null jika tidak ada hasil
    }


     // Fungsi untuk mengupdate status menjadi 'Off' berdasarkan kondisi tertentu
     public function updateStatusToOff()
     {
         // Menggunakan query builder untuk update
         return $this->db->table($this->table)
             ->update(['status' => 'Off']); // Update kolom status menjadi 'Off'
     }
}
