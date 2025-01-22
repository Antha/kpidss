<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use CodeIgniter\HTTP\ResponseInterface;

class EditorController extends Controller
{
    public function upload()
    {
         // Mengambil file yang diupload dari form
        $file = $this->request->getFile('upload');
    
        // Validasi file gambar yang diupload
        if (!$this->validate([
        'upload' => 'uploaded[upload]|is_image[upload]|mime_in[upload,image/jpg,image/jpeg,image/png,image/gif]|max_size[upload,4096]'
        ])) {
            // Mengembalikan error jika validasi gagal
            return $this->response->setJSON([
                'error' => $this->validator->getErrors()
            ]);
        }

        // Tentukan path untuk menyimpan gambar
        $path = FCPATH . 'uploads/quill';

        // Pastikan file belum dipindahkan
        if (!$file->hasMoved()) {
            // Membuat nama file yang unik
            $newName = $file->getRandomName();
            $file->move($path, $newName);

            // Mengembalikan URL gambar yang diupload
            return $this->response->setJSON([
                'url' => base_url('uploads/quill/' . $newName)
            ]);
        } else {
            // Menangani error jika file sudah dipindahkan
            return $this->response->setStatusCode(500)->setJSON([
                'error' => 'Failed to upload image. Error: ' . $file->getErrorString()
            ]);
        }
    }
}
