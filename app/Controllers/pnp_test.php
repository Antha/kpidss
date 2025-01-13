<?php

namespace App\Controllers;

use App\Models\UserQuizModel;
use CodeIgniter\Controller;
use Config\Session;

class Pnp_test extends Controller
{
    public function index()
    {
        $session = Session();
        $userQuizModel = new UserQuizModel();
        $resumeResults = $userQuizModel->getSummaryPNP();

        if($session->get('user_level') == "admin"){
            return view('pnp_test_admin_page', ['resumeResults' => $resumeResults]);
        }
        else{
            return view('forbidden_page');
        }
    }
}
