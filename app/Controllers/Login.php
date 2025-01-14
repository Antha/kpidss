<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {
        //echo "hai";
        return view('login_page');
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'user_level' => $user["level"],
                    'agent_id' => $user['agent_id'],
                    'digipos_id' => $user['digipos_id'],
                    'regional' => $user['regional'],
                    'branch' => $user['branch'],
                    'isLoggedIn' => true,
                ]);

                writeLogToFile("user_level : ".$user["level"]);
                
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Invalid Password');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'User not found');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
