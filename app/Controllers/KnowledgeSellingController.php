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

        // Ambil semua data kolom pic
        $pics = $model->select('pic')->findAll();
  
        return view('selling_page',['pics' => $pics]);
    }

    
}
