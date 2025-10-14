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
        $session = session();

        if($session->get('cluster') == "LOMBOK"){
            $type = "LMBK";
        }else{
            $type = ($session->get('role')  == "SPV DS") ? "DS" : $session->get('role') ;
        }
       
        return $this->asArray()
            ->where('id', $number)
            ->first('type',  $type);
    }

    // Ambil pertanyaan berdasarkan nomor urut
    public function get_min_id_on_status() {
        $session = session();

        if($session->get('cluster') == "LOMBOK"){
            $type = "LMBK";
        }else{
            $type = ($session->get('role')  == "SPV DS") ? "DS" : $session->get('role') ;
        }

        $this->selectMin('id'); // selectMin untuk memilih nilai minimum
        $this->where('status', 'On');
        $this->where('type',  $type);
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

     public function countOnStatus()
     {
         // Ambil instance Query Builder dari model
         $builder = $this->builder();
         $session = session();

         if($session->get('cluster') == "LOMBOK"){
            $type = "LMBK";
         }else{
            $type = ($session->get('role')  == "SPV DS") ? "DS" : $session->get('role') ;
         }
         // Tambahkan kondisi WHERE
         $builder->where('status', 'On');
         if ($type !== null) {
             $builder->where('type', $type);
         }
     
         // Clone builder untuk melihat query tanpa mengganggu eksekusi
         $debugBuilder = clone $builder;
         $sql = $debugBuilder->selectCount('*', 'total')->getCompiledSelect();
         log_message('debug', 'Generated SQL: ' . $sql); // Atau gunakan dd($sql) untuk melihat langsung
     
         // Eksekusi query dan ambil hasil count
         $result = $builder->selectCount('*', 'total')->get()->getRow();
         $count = $result->total ?? 0;
     
         return $count;
     }
     
}
