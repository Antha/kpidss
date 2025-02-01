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

    }
        
        

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the request.
    }
}
