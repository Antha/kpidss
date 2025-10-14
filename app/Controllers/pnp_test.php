<?php

namespace App\Controllers;

use App\Models\UserQuizModel;
use CodeIgniter\Controller;
use Config\Session;
use ZipArchive;

class Pnp_test extends Controller
{
    public function index()
    {
        $session = Session();
        $userQuizModel = new UserQuizModel();
        $getLastUpdateData = $userQuizModel->getLastUpdateData();

        if(!isset($getLastUpdateData['datetime'])){
            $lastUpdateData = date('Y-m-d');
            $displayPeriode = date('Ym');
        }else{
            $lastUpdateData = date("Y-m-d",strtotime($getLastUpdateData['datetime']));
            $displayPeriode = date("Ym",strtotime($getLastUpdateData['datetime']));
        }

        $getDsLoginReport = $userQuizModel->getDsLoginReport();

        if($this->request->getPost('submit_periode_data_pnp_test')){
            $periodeSubmit = $this->request->getPost('periode_data_pnp_test');
            $branchSubmit = $this->request->getPost('filter_branch_admin');
            $clusterSubmit = $this->request->getPost('filter_cluster_admin');
            $citySubmit = $this->request->getPost('filter_city_admin');
        }else{
            $periodeSubmit = $displayPeriode;
            $branchSubmit = NULL;
            $clusterSubmit = NULL;
            $citySubmit = NULL;
        }

        if(!isset($branchSubmit) || $branchSubmit == 'ALL'){
            $branch_var = '';
        }else{
            $branch_var = "AND BRANCH = '".$branchSubmit."'";
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

        $resumeResults = $userQuizModel->getSummaryPNP($periodeSubmit,$where_var);
        //

        if(!isset($resumeResults) || !$resumeResults){
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

    function lombok_test_result(){
        $session = Session();
        $userQuizModel = new UserQuizModel();
        $getLastUpdateData = $userQuizModel->getLastUpdateData();

        if(!isset($getLastUpdateData['datetime'])){
            $lastUpdateData = date('Y-m-d');
            $displayPeriode = date('Ym');
        }else{
            $lastUpdateData = date("Y-m-d",strtotime($getLastUpdateData['datetime']));
            $displayPeriode = date("Ym",strtotime($getLastUpdateData['datetime']));
        }

        $resumeResults = $userQuizModel->getSummaryPNPLombok();
        $highestRightQuestion = $userQuizModel->getHighestRightQuestion();

        $lowestRightQuestion = $userQuizModel->getLowestRightQuestion();
        return view('pnp_test_lombok_admin_page', ['resumeResults' => $resumeResults,'lastUpdateData' => $lastUpdateData,'hrQuestion' => $highestRightQuestion, 'lrQuestion' => $lowestRightQuestion]);
    }

    function get_score_detail(){
        $userQuizModel = new UserQuizModel();
        //get product id
        $quiz_id = $_POST['quizId'];

        //run query for getting product poin
        $score_detail = $userQuizModel->getScoreDetail($quiz_id);

        $parse_value = array('info' => "good",'parse_score_detail' => $score_detail);
        echo json_encode($parse_value);
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

    public function downloadImages()
    {
        $userQuizModel = new UserQuizModel();
        
        $periodeSubmit = $this->request->getPost('periode_dl_hidden');
        $where_var = '';
        $users = $userQuizModel->getSummaryPNP($periodeSubmit,$where_var);

        $zip = new ZipArchive();
        $zipFileName = 'user_photos_'.$periodeSubmit.'.zip';
        $zipPath = WRITEPATH . $zipFileName;

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return $this->response->setStatusCode(500)->setBody("Gagal membuat ZIP file.");
        }

        foreach ($users as $user) {
            $photoPath = FCPATH . 'uploads/photos/' . $user['photo']; // Path ke foto

            if (file_exists($photoPath)) {
                $newFileName = $user['DSS Name'] . '.' . pathinfo($photoPath, PATHINFO_EXTENSION);
                $zip->addFile($photoPath, $newFileName);
            }
        }

        $zip->close();

        return $this->response->download($zipPath, null)->setFileName($zipFileName);
    }

}
