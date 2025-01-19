<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\QuestionModel;
use App\Models\QuestionAnswerModel;
use App\Models\UserQuizModel;

class Loyalty extends Controller
{
    public function index()
    {
        return view('loyalty_page');
    }

    public function index_example()
    {
        return view('example/upload_file_crop_page');
    }

    public function upload_photo()
    {
        $file = $this->request->getFile('croppedImage');

        if ($file && $file->isValid()) {
            $newName = $file->getRandomName(); // Generate random name
            $file->move(FCPATH  . 'uploads/loyalty', $newName); // Save file to 'writable/uploads'

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Image uploaded successfully',
                'file_name' => $newName,
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Failed to upload image',
        ]);
    }

}
