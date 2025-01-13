<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {
        //echo "hai";
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        //$user = $model->where('username', $username)->first();

        /*if ($user) {
            if (!password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'isLoggedIn' => true,
                ]);
                
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Invalid Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'User not found');
            return redirect()->to('/login');
        }*/
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
