<?php

namespace App\Controllers;
use App\Models\UserQuizModel;
use App\Models\Loyalty_model;

class Camera extends BaseController
{
    protected $userQuizModel;
    protected $loyalty_model;


    public function __construct()
    {
        $this->userQuizModel = new UserQuizModel();
        $this->loyalty_model = new Loyalty_model();
    }

    public function index()
    {
        $session = session();
        $session->remove('quiz_processed');
        $userId = $session->get('user_id');
        
        $unfinishedQuiz = $this->userQuizModel->getUnfinishedQuizzesByUser($userId);
        $session->set("unfinishedQuiz",$unfinishedQuiz);
        
        $recentFinishedQuiz = $this->userQuizModel->getRecentFinishedQuiz($userId);
        $session->set("recentFinishedQuiz",$recentFinishedQuiz);

        $results= $this->loyalty_model->getPoint($session->get("user_id"));
        //dd($results);
        $data['display_user_point'] = $results[0]["point_now"];

        return view('camera_page',$data);
    }

    public function save()
    {
        // Ambil data gambar dari POST
        $post = $this->request->getPost();
        $imageData = $this->request->getPost('imageData');
        $mylong = array_key_exists('mylong', $post) ? $post['mylong'] : 0;
        $mylat  = array_key_exists('mylat', $post) ? $post['mylat'] : 0;

        writeLogToFile("mylong :". $mylong." - mylat : ".$mylat);

        if ($imageData) {
            // Simpan data gambar ke dalam session
            ///writeLogToFile("imageData : ".$imageData);
            session()->set('capturedImage', $imageData);
            session()->set('myinput_location', $post["myinput_location"]);
            session()->set('mylat', $mylat);
            session()->set('mylong', $mylong);
        }

        return redirect()->to('/quiz');
    }
}
