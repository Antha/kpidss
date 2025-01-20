<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\QuestionModel;
use App\Models\QuestionAnswerModel;
use App\Models\UserQuizModel;

class Dashboard extends Controller
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

        writeLogToFile("UQI ". json_encode($unfinishedQuiz));
        $session->set("unfinishedQuiz",$unfinishedQuiz);

        $recentFinishedQuiz = $this->userQuizModel->getRecentFinishedQuiz($userId);
        $session->set("recentFinishedQuiz",$recentFinishedQuiz);

        return view('dashboard_page',["unfinishedQuiz" => $unfinishedQuiz]);
    }

    
}
