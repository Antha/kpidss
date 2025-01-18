<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\QuestionModel;
use App\Models\QuestionAnswerModel;
use App\Models\UserQuizModel;

class Loyalty extends Controller
{
    public function index()
    {
        return view('loyalty_page');
    }
}
