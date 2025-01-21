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

        $resumeResults = $userQuizModel->getSummaryPNP($displayPeriode);
        
        if($session->get('user_level') == "admin"){
            return view('pnp_test_admin_page', ['resumeResults' => $resumeResults,'lastUpdateData' => $lastUpdateData,'displayPeriode' => $displayPeriode]);
        }
        else{
            return redirect()->to('/camera');
        }
    }

    function download_test_result(){
        if($this->request->getPost('btn_dl_test_result')){
            $userQuizModel = new UserQuizModel();
            $periode = $this->request->getPost('periode_dl');

            $filename = 'DOWNLOAD TEST RESULT '.$periode.'.csv'; 
            header("Content-Description: File Transfer"); 
            header("Content-Disposition: attachment; filename=$filename"); 
            header("Content-Type: application/csv; ");

            // file creation 
            $file = fopen('php://output', 'w');
            
            $header = array('Agent ID','Digipos ID','DSS Name','Test Date','Right Answer','Wrong Answer','Score','Status');

            fputcsv($file, $header);

            $data_dl =$userQuizModel->getSummaryPNP($periode);;

            foreach ($data_dl as $key=>$line){ 
                fputcsv($file,$line); 
            }
            fclose($file); 
            exit;
        }
    }
}
