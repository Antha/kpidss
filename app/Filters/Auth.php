<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        /*if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }*/

        $session = session();
        $userModel = new UserModel();
        $timeout = 299; // 5 minutes timeout
        $lastActivity = $session->get('last_activity');
        d(time(),$lastActivity,time() - $lastActivity,$session->get('user_id'));

        if ((time() - $lastActivity >= $timeout)) {
              
            echo "test";
            $sql = "UPDATE user WHERE id='".$session->get('user_id')."' SET session_id = null";
            echo $sql;            
            // Remove session_id from database
            //$userModel->update($session->get('user_id'), ['session_id' => null]);

            // Destroy session
            //$session->destroy();
            //return redirect()->to('/login')->with('error', 'Session expired due to inactivity.');
        }else{
            return redirect()->to('/login');
        }
        //$session->set('last_activity', time());


        /*if ($session->has('user_id')) {
            $lastActivity = $session->get('last_activity');
            $timeout = 300; // 5 minutes timeout

            // If last activity exceeds timeout, log the user out
            if ($lastActivity && (time() - $lastActivity > $timeout)) {
               
                // Remove session_id from database
                $userModel->update($session->get('user_id'), ['session_id' => null]);

                // Destroy session
                $session->destroy();
                return redirect()->to('/login')->with('error', 'Session expired due to inactivity.');
            }

            // Update last activity timestamp
            $session->set('last_activity', time());
        }else {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }*/
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request.
    }
}
