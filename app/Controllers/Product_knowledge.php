<?php

namespace App\Controllers;

use App\Models\Product_knowledge_model;
use CodeIgniter\Controller;

use CodeIgniter\HTTP\ResponseInterface;

class Product_knowledge extends Controller
{
    protected $product_knowledge_model;

    function __construct()
    {
        $this->product_knowledge_model = new Product_knowledge_model();
    }

    public function index()
    {
        //dummy data for query result of calculating user point
        
        $data['display_all_product'] = $this->product_knowledge_model->display_all_product();

        return view('product_knowledge_page',$data);
    }

    public function input_data()
    {
        $session = session();
        $datetime_now = date("Y-m-d H:i:s");
        $data['dt_now'] = $datetime_now;

        if($session->get("user_level") == 'admin'){
            return view('product_knowledge_input_page',$data);
        }else{
            return redirect()->to(base_url('/dashboard')); 
        }
        
    }

    function get_detail_product(){
        //get product id
        $product_id = $_POST['product_id'];

        //run query for getting product poin
        $get_product_detail = $this->product_knowledge_model->get_product_detail($product_id);

        $parse_value = array('info' => "good", 'parse_product_name' => $get_product_detail[0]['product_name'], 'parse_product_detail' => $get_product_detail[0]['product_detail']);
        echo json_encode($parse_value);
    }

    //this is just for example
    public function upload_photo()
    {
        $file = $this->request->getFile('croppedImage');

        if ($file && $file->isValid()) {
            $newName = $file->getRandomName(); // Generate random name
            $file->move(FCPATH  . 'uploads/product_knowledge', $newName); // Save file to 'writable/uploads'

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

    public function upload_data()
    {
         // Validasi request POST
         if ($this->request->getMethod() !== 'POST') {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ], ResponseInterface::HTTP_METHOD_NOT_ALLOWED);
        }

        // Validasi data yang dikirim
        $rules = [
            'product_name' => 'required',
            'product_detail' => 'required',
            'croppedImage' => 'uploaded[croppedImage]|is_image[croppedImage]|mime_in[croppedImage,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $this->validator->getErrors(),
            ], ResponseInterface::HTTP_BAD_REQUEST);
        }

        // Ambil data dari request
        $productName = $this->request->getPost('product_name');
        $productDetail = $this->request->getPost('product_detail');
        $imageFile = $this->request->getFile('croppedImage');
        //$description = $this->request->getPost('description');

        writeLogToFile("imageFile : ".$imageFile);

        // Proses upload file gambar
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName(); // Buat nama file unik
            $imageFile->move(FCPATH  . 'uploads/product_knowledge', $imageName); // Simpan file ke folder uploads
            writeLogToFile("imageName : ".$imageName);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to upload image'
            ], ResponseInterface::HTTP_BAD_REQUEST);
        }

        // Simpan data ke database
        $data = [
            'product_name' => $productName,
            'product_detail' => $productDetail,
            'product_image' => $imageName// Simpan nama file gambar ke kolom 'image'
        ];

        writeLogToFile(json_encode($data));

        if ($this->product_knowledge_model->insertData($data)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Product added successfully',
                'data' => $data,
            ]);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to save data to database',
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    function detail(){
        $uri = current_url(true);
        $get_url_query = $uri->getQuery();
        $exp = explode('product_id=',$get_url_query);
        $product_id = $exp[1];

        $data['detail'] = $this->product_knowledge_model->get_product_detail($product_id);
        
        return view('product_knowledge_detail_page',$data);
    }
}
