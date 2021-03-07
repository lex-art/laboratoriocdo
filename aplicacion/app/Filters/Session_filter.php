<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Session_filter implements FilterInterface
{
    /* before permite validar cosas antes de que cargue algo, 
    y queda perfecto para el las sesiones */
    public function before(RequestInterface $request, $arguments = null)
    {
        //dd($arguments);
        
        if(!session('login')) {

            if(session('privilegio') =='Administrador'||session('privilegio') =='su'){
                return redirect()->to(base_url('/app'));
            }elseif(session('privilegio') =='Recepcionista'){
                return redirect()->to(base_url('/app'));
            }else{
                return redirect()->to(base_url('/login'));
            }
            
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}