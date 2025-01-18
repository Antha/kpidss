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
