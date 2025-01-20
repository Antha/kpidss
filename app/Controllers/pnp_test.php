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
        $getLastUpdateData = $userQuizModel->getLastUpdateData();
        $lastUpdateData = date("Y-m-d",strtotime($getLastUpdateData['datetime']));
        $displayPeriode = date("Ym",strtotime($getLastUpdateData['datetime']));

        $resumeResults = $userQuizModel->getSummaryPNP();
        
        if($session->get('user_level') == "admin"){
            return view('pnp_test_admin_page', ['resumeResults' => $resumeResults,'lastUpdateData' => $lastUpdateData,'displayPeriode' => $displayPeriode]);
        }
        else{
            return redirect()->to('/camera');
        }
    }
}
