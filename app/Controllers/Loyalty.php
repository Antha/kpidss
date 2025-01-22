<?php

namespace App\Controllers;

use App\Models\Loyalty_model;
use CodeIgniter\Controller;

use CodeIgniter\HTTP\ResponseInterface;

class Loyalty extends Controller
{
    protected $loyalty_model;

    function __construct()
    {
        $this->loyalty_model = new Loyalty_model();
    }

    public function index()
    {
        //dummy data for query result of calculating user point
        
        //$query_result_user_point = 300;
        $session = session();
        $results= $this->loyalty_model->getPoint($session->get("user_id"));

        //display user point
         // Fetch the product redeems for user_id = 6
        $data['product_redeems'] = $this->loyalty_model->getProductRedeemsByUser($session->get("user_id"));
        $data['display_user_point'] = $results[0]["point_now"];
        $data['display_all_product'] = $this->loyalty_model->display_all_product();

        return view('loyalty_page',$data);
    }

    public function input_data()
    {
        $session = session();
        if($session->get("user_level") == 'admin'){
            $data['display_all_product'] =  $this->loyalty_model->display_all_product();

            return view('loyalty_input_page',$data);
        }else{
            return redirect()->to(base_url('/dashboard')); 
        }
        
    }

    function cek_redeem_point(){
        $session = session();
        //
        $results= $this->loyalty_model->getPoint($session->get("user_id"));

        //dummy data for query result of calculating user point
        $query_result_user_point = $results[0]["point_now"];

        //get product id
        $product_id = $_POST['product_id'];

        //run query for getting product poin
        $get_product_point = $this->loyalty_model->get_product_point($product_id);

        if($query_result_user_point > $get_product_point[0]['product_point'])
        {
            if($get_product_point[0]['product_point'] == 0){
                $parse_value = array('info' => "empty stock");
                echo json_encode($parse_value);
            }else{
                $parse_value = array('info' => "good",'parse_product_point' => $get_product_point[0]['product_point'], 'parse_product_name' => $get_product_point[0]['product_name']);
                echo json_encode($parse_value);
            }
        }else{
            $parse_value = array('info' => "not enough point");
            echo json_encode($parse_value);
        }
    }

    function redeem_process(){
        $session = session();

        $product_id = $_POST['product_id'];
        $userId = $session->get("user_id");
        $get_product_point = $this->loyalty_model->get_product_point($product_id);

        $this->loyalty_model->redeem_process_product($product_id, $userId, $get_product_point[0]['product_point']);
        //belum dengan dikurangi user-point - product-point
        echo "success";
    }

    function get_product_stock(){
        $product_id = $_POST['product_id'];
        $get_product_point = $this->loyalty_model->get_product_point($product_id);
        
        $parse_value = array('info' => 'success','product_stock' => $get_product_point[0]['product_stock'],'product_name' => $get_product_point[0]['product_name'],'product_point' => $get_product_point[0]['product_point']);
        echo json_encode($parse_value);
    }

    public function index_example()
    {
        return view('example/upload_file_crop_page');
    }

    //this is just for example
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
            'product_point' => 'required|numeric',
            'product_stock' => 'required|numeric',
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
        $productPoint = $this->request->getPost('product_point');
        $productStock = $this->request->getPost('product_stock');
        $imageFile = $this->request->getFile('croppedImage');

        writeLogToFile("imageFile : ".$imageFile);

        // Proses upload file gambar
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName(); // Buat nama file unik
            $imageFile->move(FCPATH  . 'uploads/loyalty', $imageName); // Simpan file ke folder uploads
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
            'product_point' => $productPoint,
            'product_stock' => $productStock,
            'product_image' => $imageName, // Simpan nama file gambar ke kolom 'image'
        ];

        writeLogToFile(json_encode($data));

        if ($this->loyalty_model->insertData($data)) {
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

    function edit_product_redeem_detail(){
        $session = session();

        $admin_id = $session->get('user_id');
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_stock = $_POST['product_stock'];
        $product_point = $_POST['product_point'];
        
        //edit product detail
        $this->loyalty_model->edit_product_detail($product_id,$product_name,$product_stock,$product_point,$admin_id);
        
        echo "success";
    }

    public function update_redeem_status()
    {
        $redeemID = $this->request->getPost("redeemID");
        try {
            if ($this->loyalty_model->update_redeem_status($redeemID)) {
                return $this->response->setJSON([
                    'status' => 'success',
                    'message' => 'Redeem status changed successfully',
                ]);
            } else {
                throw new \Exception('No rows affected');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], ResponseInterface::HTTP_INTERNAL_SERVER_ERROR);
        }
        
    }


}
