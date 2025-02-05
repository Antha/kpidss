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
        $getDsLoginReport = $userQuizModel->getDsLoginReport();

        if($this->request->getPost('submit_periode_data_pnp_test')){
            $periodeSubmit = $this->request->getPost('periode_data_pnp_test');
            $branchSubmit = $this->request->getPost('filter_branch_admin');
            $clusterSubmit = $this->request->getPost('filter_cluster_admin');
            $citySubmit = $this->request->getPost('filter_city_admin');
        }else{
            $periodeSubmit = $lastUpdateData;
            $branchSubmit = NULL;
            $clusterSubmit = NULL;
            $citySubmit = NULL;
        }

        if(!isset($branchSubmit) || $branchSubmit == 'ALL'){
            $branch_var = '';
        }else{
            $branch_var = "WHERE BRANCH = '".$branchSubmit."'";
        }

        if(!isset($clusterSubmit)){
            $cluster_var = '';
        }else{
            $cluster_var = " AND CLUSTER = '".$clusterSubmit."'";
        }

        if(!isset($citySubmit)){
            $city_var = '';
        }else{
            $city_var = " AND CITY = '".$citySubmit."'";
        }

        $where_var = $branch_var.''.$cluster_var.''.$city_var;

        $resumeResults = $userQuizModel->getSummaryPNP($displayPeriode,$where_var);

        if(!isset($resumeResults)){
            $bestDs = '';
        }else{
            $bestDs = $resumeResults[0]['DSS Name'];
        }
        
        if($session->get('user_level') == "admin"){
            return view('pnp_test_admin_page', ['resumeResults' => $resumeResults,'lastUpdateData' => $lastUpdateData,'displayPeriode' => $displayPeriode, 'getDsLoginReport' => $getDsLoginReport, 'bestDs' => $bestDs]);
        }else if($session->get('user_level') == "admin_cms"){
            return redirect()->to('/dashboard');
        }
        else{
            return redirect()->to('/camera');
        }
    }

    /*function download_test_result(){
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

            $data_dl =$userQuizModel->getSummaryPNP($periode);

            foreach ($data_dl as $key=>$line){ 
                fputcsv($file,$line); 
            }
            fclose($file); 
            exit;
        }
    }*/
}
