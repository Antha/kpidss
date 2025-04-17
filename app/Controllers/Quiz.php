<?php

namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\QuestionAnswerModel;
use App\Models\UserQuizModel;
use App\Models\UserQuizTimerModel;
use App\Models\UsersPointsModel;

class Quiz extends BaseController
{
    protected $questionModel;
    protected $questionAnswerModel;
    protected $userQuizModel;
    protected $userQuizTimerModel;
    protected $usersPointsModel;

    public function __construct()
    {
        // Initialize the QuestionModel
        $this->questionModel = new QuestionModel();
        $this->questionAnswerModel = new QuestionAnswerModel();
        $this->userQuizModel = new UserQuizModel();
        $this->userQuizTimerModel = new UserQuizTimerModel();
        $this->usersPointsModel = new UsersPointsModel();
    }

    public function index($questionNumber = 1)
    {
        $session = session();

        $userId = $session->get('user_id');
        $unfinishedQuiz = $this->userQuizModel->getUnfinishedQuizzesByUser($userId);

        //writeLogToFile("session()->get('capturedImage') : ".session()->get('capturedImage'));

        if(session()->has('capturedImage') || $unfinishedQuiz["photo"]){
            if($session->get("user_level") == 'agent_branch' || $session->get("user_level") == 'agent_cluster'){
                $fileName = "";
                $quizId = "";
                if($unfinishedQuiz){
                    $quizId = $unfinishedQuiz["id"];
                    $fileName = $unfinishedQuiz["photo"];
                    $mylong = $unfinishedQuiz["long"];
                    $mylat = $unfinishedQuiz["lat"];
    
                    $session->set('id_quiz', $quizId);
                    $session->set('file_name', $fileName);
                    $session->set('mylong', $mylong);
                    $session->set('mylat', $mylat);
                }
                // $stringUN =  json_encode($unfinishedQuiz);
                // writeLogToFile( $stringUN);
    
                if ($this->request->getMethod() === 'POST') {
                    if($unfinishedQuiz){
                        $quizId = $unfinishedQuiz["id"];
                        $fileName = $unfinishedQuiz["photo"];
                        $mylong = $unfinishedQuiz["long"];
                        $mylat = $unfinishedQuiz["lat"];
    
                        writeLogToFile("fileName : ".$fileName);
                        writeLogToFile("ulong : ".$unfinishedQuiz["long"]);
    
                        // Data yang akan dimasukkan atau di-replace
                        $data = [
                            'id' => $quizId,
                            'user_id' => $userId,
                            'photo' => $fileName,
                            'long' => $mylong,
                            'lat' => $mylat,
                            'status' => 'unfinished',
                            'datetime' => date('Y-m-d H:i:s'),
                        ];
    
                        // Panggil metode replaceData
                        $result = $this->userQuizModel->replaceData($data);
    
                    }else{
                         // Data yang akan dimasukkan atau di-insert
                         $fileName = $this->saveBase64Image($session->get("capturedImage"), "./uploads/photos");
                         $mylong = $session->get('mylong');
                         $mylat = $session->get('mylat');
 
                         //$fileName = 0;
 
                         if($fileName && $fileName !== false){
                             $data = [
                                 'user_id' => $userId,
                                 'photo' => $fileName,
                                 'long' => $session->get('mylong'),
                                 'lat' => $session->get('mylat'),
                                 'status' => 'unfinished',
                                 'datetime' => date('Y-m-d H:i:s'),
                             ];
 
                             // Panggil metode replaceData
                             $quizId = $this->userQuizModel->insertAndGetId($data);
                         }else{
                             session()->setFlashdata('errors_camera', 'Terjadi kesalahan saat memproses data. Periksa Jaringan Anda');
                             return redirect()->to(base_url('/camera'));
                         }
                    }
    
                    $session->set('id_quiz', $quizId);
                    $session->set('file_name', $fileName);
                    $session->set('mylong', $mylong);
                    $session->set('mylat', $mylat);
    
                    //===================Simpan Jawaban
                    // Ambil jawaban dari POST
                    $answer = $this->request->getPost('answer');
                    $questionId = $this->request->getPost('question_id');
    
                    // // Simpan jawaban ke session satu per satu
                    // $answers = $session->get('quiz_answers') ?? [];
                    // $answers[$questionId] = $answer;
                    // $session->set('quiz_answers', $answers);
    
                    $this->questionAnswerModel->ignore(true)->save([
                        'user_id' => $userId,
                        'quiz_id' => $quizId,
                        'question_id' => $questionId,
                        'answer' => $answer,
                    ]);
    
                }
    
                $reslutsMQB = $this->questionAnswerModel->getMaxQuestionIdByUserId($userId, (int) $quizId);
                if($reslutsMQB){
                    $questionNumber = (int) $reslutsMQB->max_qid + 1;
                    $question_no = $reslutsMQB->no + 1;
    
                    writeLogToFile("question_no_here : ".$question_no);
                }else{
                    $questionNumber = $this->questionModel->get_min_id_on_status();
                    $question_no = 1;
                    writeLogToFile("question_no_here : ".$question_no);
                }
    
                if ($question_no > $this->questionModel->countAll()) {
                    return redirect()->to('/quiz/result');
                }else{
                
                    // Ambil pertanyaan saat ini
                    writeLogToFile("questionNumber : ".$questionNumber);
                    $question = $this->questionModel->getQuestionByNumber($questionNumber);
    
                    return view('quiz_page', [
                        'question' => $question,
                        'question_no' => $question_no,
                        'questionNumber' => $questionNumber
                    ]);
                }
            }else if($session->get("user_level") == 'admin' || $session->get("user_level") == 'admin_cms'){
                return redirect()->to(base_url('/dashboard')); 
            }else{
                return redirect()->to(base_url('/login'));
            }
        }else{
            return redirect()->to(base_url('/camera'));
        }
        
    }


    public function result()
    {
        $session = session();
        $quizAnswers = $session->get('quiz_answers');

        $userId = $session->get('user_id');
        $quizId = $session->get('id_quiz');
        $fileName = $session->get('file_name');
        $mylong = $session->get('mylong');
        $mylat = $session->get('mylat');
    
        // Data yang akan dimasukkan atau di-replace
        $data = [
            'id' => $quizId,
            'user_id' => $userId,
            'photo' => $fileName,
            'long' => $mylong,
            'lat' => $mylat,
            'status' => 'finished',
            'datetime' => date('Y-m-d H:i:s'),
        ];

        // Panggil metode replaceData
        $result = $this->userQuizModel->replaceData($data);

        //writeLogToFile($this->userQuizModel->getLastQuery());

        $quizAnswers = $this->questionAnswerModel->getAnswersByUserId($userId, (int) $quizId);

        // Bersihkan session jawaban setelah disimpan
        $session->remove('quiz_answers');

        // Delete user timer
        $this->userQuizTimerModel->deleteByUserId($userId);

        //insert to point
        $totalIsRight = 0;
        $poinVal = 0;
        
        foreach ($quizAnswers as $item) {
            $totalIsRight += $item['is_right'];
        }

        switch($totalIsRight){
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
                $poinVal = 0;
                break;
            case 6:
                $poinVal = 80;
                break;
            case 7:
                $poinVal = 90;
                break;
            case 8:
                $poinVal = 100;
                break;
            case 9:
                $poinVal = 110;
                break;
            case 10:
                $poinVal = 150;
                break;
        }

        $dataPoint = [
            'user_id'    => $userId,
            'point'       => $poinVal,
            'point_category' => "Quiz",
            'periode'     => date("Ym"),
        ];

        $this->usersPointsModel->insert($dataPoint);

        // Tampilkan hasil atau redirect ke halaman lain
        return view('quiz_result_page', ['answers' => $quizAnswers]);
    }

    function saveBase64Image($base64String, $uploadPath) {
        // Cek apakah data Base64 valid
        if (preg_match('/^data:image\/(\w+);base64,/', $base64String, $type)) {
            $base64String = substr($base64String, strpos($base64String, ',') + 1); // Hapus prefix Base64
            $type = strtolower($type[1]); // Dapatkan tipe file (png, jpg, jpeg, dll)

            // Pastikan tipe file valid
            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                return false;
            }

            $base64String = base64_decode($base64String); // Decode Base64
            if ($base64String === false) {
                return false;
            }

            // Buat nama file unik
            $fileName = uniqid() . '.' . $type;

            // Simpan file ke folder upload
            $filePath = rtrim($uploadPath, '/') . '/' . $fileName;
            if (file_put_contents($filePath, $base64String)) {
                return $fileName; // Return nama file
            }
        }

        return false; // Jika gagal
    }

     // Simpan sisa waktu ke database
     public function saveRemainingTime()
     {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST");
        header("Access-Control-Allow-Headers: Content-Type");

         $session = session();
         $userId = $session->get('user_id');

         //$userId = $this->request->getPost('user_id'); // ID pengguna
         $json = $this->request->getJSON();
         writeLogToFile("saved remaining time :".$json->remaining_seconds);
         $remainingSeconds = $json->remaining_seconds; // Sisa waktu dalam detik
 
         // Cek apakah user sudah memiliki timer
         $this->userQuizTimerModel->where('user_id', $userId);
         $existingTimer = $this->userQuizTimerModel->get()->getRow();

         writeLogToFile(json_encode($existingTimer));
 
         if ($existingTimer) {
             // Update sisa waktu
             writeLogToFile("update sisa waktu : ".$remainingSeconds) ;  
             $this->userQuizTimerModel->updateRemainingTime($userId, $remainingSeconds);
         } else {
             // Simpan waktu baru
             writeLogToFile("insert waktu terbaru :".$json->remaining_seconds) ; 
             $this->userQuizTimerModel->insert([
                 'user_id' => $userId,
                 'remaintime' => (int) $remainingSeconds
             ]);
            
         }

       
 
         return $this->response->setJSON(['status' => 'success']);
     }

     // Ambil sisa waktu dari database
    public function getRemainingTime()
    {
        $session = session();
        
        $userId = $session->get('user_id'); // ID pengguna

        $timer =  $this->userQuizTimerModel->where('user_id', $userId)->get()->getRow();

        if ($timer) {
            return $this->response->setJSON([
                'status' => 'success',
                'remaining_seconds' => $timer->remaintime,
            ]);
        } else {
            return $this->response->setJSON(['status' => 'not_found']);
        }
    }
}
