<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class Login extends Controller
{
    public function index()
    {
        $session = session();
        if($session->get("isLoggedIn") == TRUE){
            return redirect()->to(base_url('/dashboard'));
        }else{
            return view('login_page'); 
        }
    }

    public function authenticate()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Generate a unique session ID
                $sessionID = bin2hex(random_bytes(32));

                // Check if user is already logged in
                if (!empty($user['session_id'])) {
                    return redirect()->back()->with('error', 'You are already logged in on another device.');
                }

                // Update session ID in the database
                $model->update($user['id'], ['session_id' => $sessionID]);

                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'user_level' => $user["level"],
                    'agent_id' => $user['agent_id'],
                    'digipos_id' => $user['digipos_id'],
                    'regional' => $user['regional'],
                    'branch' => $user['branch'],
                    'cluster' => $user['cluster'],
                    'session_id' => $sessionID,
                    'last_activity' => time(), // Track last activity
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
        //session()->destroy();
        //return redirect()->to('/login');

        $session = session();
        $userModel = new UserModel();

        if ($session->has('user_id')) {
            $userModel->update($session->get('user_id'), ['session_id' => null]);
        }

        $session->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully.');
    }
}
