<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Editor extends Controller
{
  

    public function upload()
    {
        if ($file = $this->request->getFile('file')) {
            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move(FCPATH . 'uploads/tinymce', $newName); // Simpan di folder uploads
                return $this->response->setJSON(['location' => base_url('writable/uploads/' . $newName)]);
            }
        }
        return $this->response->setJSON(['error' => 'Upload failed'], 400);
    }
}
