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
        //$session = session();
        //$userModel = new UserModel();

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        /*if ($session->has('user_id')) {
            $user = $userModel->find($session->get('user_id'));

            // Check if session matches the database
            if (!$user || $user['session_id'] !== $session->get('session_id')) {
                $session->destroy();
                return redirect()->to('/login')->with('error', 'Session expired. Please log in again.');
            }
        } else {
            return redirect()->to('/login')->with('error', 'You must be logged in to access this page.');
        }*/
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request.
    }
}
