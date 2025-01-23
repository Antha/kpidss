<?php

namespace App\Controllers;
use App\Models\UserQuizModel;

class Camera extends BaseController
{
    protected $userQuizModel;

    public function __construct()
    {
        $this->userQuizModel = new UserQuizModel();
    }

    public function index()
    {
        $session = session();
        $userId = $session->get('user_id');
        
        $unfinishedQuiz = $this->userQuizModel->getUnfinishedQuizzesByUser($userId);
        // writeLogToFile("UQI ". json_encode($unfinishedQuiz));
        $session->set("unfinishedQuiz",$unfinishedQuiz);
        
        $recentFinishedQuiz = $this->userQuizModel->getRecentFinishedQuiz($userId);
        $session->set("recentFinishedQuiz",$recentFinishedQuiz);

        return view('camera_page');
        
    }

    public function save()
    {
        // Ambil data gambar dari POST
        $imageData = $this->request->getPost('imageData');
        $mylong = $this->request->getPost('mylong');
        $mylat = $this->request->getPost('mylat');

        writeLogToFile("mylong :". $mylong." - mylat : ".$mylat);

        if ($imageData) {
            // Simpan data gambar ke dalam session
            ///writeLogToFile("imageData : ".$imageData);
            session()->set('capturedImage', $imageData);
            session()->set('mylong', $mylong);
            session()->set('mylat', $mylat);
        }

        return redirect()->to('/quiz');
    }
}
