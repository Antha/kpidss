<?php

namespace App\Controllers;

class Camera extends BaseController
{
    public function index()
    {
        $session = session();
        //writeLogToFile("uQ : ".json_encode($session->get("unfinishedQuiz")));
        if (is_array($session->get("unfinishedQuiz"))) {
            // Tampilkan quiz
            return redirect()->to('/quiz');
        } else {
            // Tampilkan halaman kamera
            return view('camera');
        }
        
    }

    public function save()
    {
        // Ambil data gambar dari POST
        $imageData = $this->request->getPost('imageData');

        if ($imageData) {
            // Simpan data gambar ke dalam session
            ///writeLogToFile("imageData : ".$imageData);
            session()->set('capturedImage', $imageData);
        }

        return redirect()->to('/quiz');
    }
}
