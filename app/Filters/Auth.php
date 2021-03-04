<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
class Auth implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn') && !session()->get('isLoggedInAdmin')){
            return redirect()->to('/');
        }else{
            if(!session()->get('isLoggedIn')){
                
            }
        }
    }
    public function after(RequestInterface $request, ResponseInterface $response,$arguments = null){
        
    }
}