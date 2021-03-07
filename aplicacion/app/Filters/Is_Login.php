<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Is_Login implements FilterInterface
{
    /* before permite validar cosas antes de que cargue algo, 
    y queda perfecto para el las sesiones */
    public function before(RequestInterface $request, $arguments = null)
    {
        if(session('login')){
            return redirect()->to(base_url('/app'));
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}