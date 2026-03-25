<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\KnowledgeSellingModel;

class KnowledgeSellingController extends Controller
{
    public function __construct()
    {
     
    }

    public function index()
    {
        
        $model = new KnowledgeSellingModel();

        $userId = session()->get('user_id');

        // Ambil semua data kolom pic berdasarkan user_id
        $pics = $model->select('pic')
              ->where('id_user', $userId)   // ganti $userId dengan variabel user yang aktif
              ->findAll();

        return view('selling_page',['pics' => $pics]);
    }

    
}
