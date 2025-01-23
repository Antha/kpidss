<?php 

// File: app/Controllers/QuestionController.php
namespace App\Controllers;

use App\Models\QuestionModel;
use CodeIgniter\Controller;

class QuestionController extends Controller
{
    public function index()
    {
        return view('questions_input_page');
    }

    public function import()
    {
        $file = $this->request->getFile('csv_file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filePath = $file->getTempName();
            $fileHandle = fopen($filePath, 'r');
    
            $questionModel = new QuestionModel();
            $questionModel->updateStatusToOff();
    
            // Deteksi delimiter secara otomatis
            $firstLine = fgets($fileHandle); // Ambil baris pertama
            fclose($fileHandle);
    
            // Coba deteksi delimiter dengan menghitung kemunculan karakter koma dan titik koma
            $delimiter = (substr_count($firstLine, ';') > substr_count($firstLine, ',')) ? ';' : ',';
    
            // Buka ulang file dengan delimiter yang sesuai
            $fileHandle = fopen($filePath, 'r');
            $header = fgetcsv($fileHandle, 0, $delimiter); // Ambil header CSV
    
            while (($row = fgetcsv($fileHandle, 0, $delimiter)) !== false) {
                writeLogToFile("row[0] = ".$row[0]);
    
                $data = [
                    'no' => $row[0],
                    'question' => $row[1],
                    'option_a'      => $row[2],
                    'option_b'      => $row[3],
                    'option_c'      => $row[4],
                    'option_d'      => $row[5],
                    'correct_option' => $row[6],
                    'status' => "On"
                ];
                $questionModel->insert($data);
            }
            fclose($fileHandle);
    
            return redirect()->to('/questions')->with('success', 'Data imported successfully');
        }
    
        return redirect()->to('/questions')->with('error', 'Invalid file upload');
    }
    

    public function sampleCsv()
    {
        $sampleData = "question_text,option_a,option_b,option_c,option_d,correct_option\n";
        $sampleData .= "What is PHP?,A programming language,A database,A web server,A framework,A\n";
        $sampleData .= "What is JavaScript?,A scripting language,An operating system,A database,A web server,A\n";

        // Set header untuk download file
        return $this->response->setHeader('Content-Type', 'text/csv')
                            ->setHeader('Content-Disposition', 'attachment; filename="sample_questions.csv"')
                            ->setBody($sampleData);
    }

}


?>