<?php

namespace App\Controllers;

class Camera extends BaseController
{
    public function index()
    {
        $session = session();
        return view('camera_page');
        
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

        return redirect()->to('/quiz_page');
    }
}
