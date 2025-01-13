<?php

namespace App\Controllers;

use App\Models\QuestionModel;
use App\Models\QuestionAnswerModel;
use App\Models\UserQuizModel;

class Quiz extends BaseController
{
    protected $questionModel;
    protected $questionAnswerModel;
    protected $userQuizModel;

    public function __construct()
    {
        // Initialize the QuestionModel
        $this->questionModel = new QuestionModel();
        $this->questionAnswerModel = new QuestionAnswerModel();
        $this->userQuizModel = new UserQuizModel();
    }

    public function index($questionNumber = 1)
    {
        $session = session();
        $userId = $session->get('user_id');
        $unfinishedQuiz = $this->userQuizModel->getUnfinishedQuizzesByUser($userId);
        $fileName = "";
        $quizId = "";
        if($unfinishedQuiz){
            $quizId = $unfinishedQuiz["id"];
        }
        // $stringUN =  json_encode($unfinishedQuiz);
        // writeLogToFile( $stringUN);

        if ($this->request->getMethod() === 'POST') {
            if($unfinishedQuiz){
                $quizId = $unfinishedQuiz["id"];
                $fileName = $unfinishedQuiz["photo"];

                writeLogToFile("fileName : ".$fileName);

                // Data yang akan dimasukkan atau di-replace
                $data = [
                    'id' => $quizId,
                    'user_id' => $userId,
                    'photo' => $fileName,
                    'status' => 'unfinished',
                    'datetime' => date('Y-m-d H:i:s'),
                ];

                // Panggil metode replaceData
                $result = $this->userQuizModel->replaceData($data);

            }else{
                // Data yang akan dimasukkan atau di-insert
                $fileName = $this->saveBase64Image($session->get("capturedImage"), "./uploads/photos");
                $data = [
                    'user_id' => $userId,
                    'photo' => $fileName,
                    'status' => 'unfinished',
                    'datetime' => date('Y-m-d H:i:s'),
                ];

                // Panggil metode replaceData
                $quizId = $this->userQuizModel->insertAndGetId($data);
            }

            $session->set('id_quiz', $quizId);
            $session->set('file_name', $fileName);

            //===================Simpan Jawaban
            // Ambil jawaban dari POST
            $answer = $this->request->getPost('answer');
            $questionId = $this->request->getPost('question_id');

            // // Simpan jawaban ke session satu per satu
            // $answers = $session->get('quiz_answers') ?? [];
            // $answers[$questionId] = $answer;
            // $session->set('quiz_answers', $answers);

            $this->questionAnswerModel->save([
                'user_id' => $userId,
                'quiz_id' => $quizId,
                'question_id' => $questionId,
                'answer' => $answer,
            ]);

        }

        // Jika pertanyaan terakhir selesai, arahkan ke halaman hasil
        if ($questionNumber > $this->questionModel->countAll()) {
            return redirect()->to('/quiz/result');
        }else{
            if($unfinishedQuiz){
                $questionNumber = $this->questionAnswerModel->getMaxQuestionIdByUserId($userId, (int) $quizId);
            }

            // Ambil pertanyaan saat ini
            writeLogToFile("questionNumber : ".$questionNumber);
            $question = $this->questionModel->getQuestionByNumber($questionNumber);

            return view('quiz', [
                'question' => $question,
                'questionNumber' => $questionNumber
            ]);
        }
    }


    public function result()
    {
        $session = session();
        $quizAnswers = $session->get('quiz_answers');
      
        // if (!$quizAnswers) {
        //     return redirect()->to('/quiz');
        // }

        $userId = $session->get('user_id');
        $quizId = $session->get('id_quiz');
        $fileName = $session->get('file_name');
    
         // Data yang akan dimasukkan atau di-replace
         $data = [
            'id' => $quizId,
            'user_id' => $userId,
            'photo' => $fileName,
            'status' => 'finished',
            'datetime' => date('Y-m-d H:i:s'),
        ];

        // Panggil metode replaceData
        $result = $this->userQuizModel->replaceData($data);

        $quizAnswers = $this->questionAnswerModel->getAnswersByUserId($userId, (int) $quizId);

        // Bersihkan session jawaban setelah disimpan
        $session->remove('quiz_answers');

        // Tampilkan hasil atau redirect ke halaman lain
        return view('quiz_result', ['answers' => $quizAnswers]);
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


}
