<?php
/**
 * Clase MailController
 * 
 * Controlador usado para enviar el mail
 * 
 * @author Oscar Fernandez Alzate (oscarfdzalz@gmail.com)
 * @copyright Código Electrónica (codigoelectronica@gmail.com)
 * @version 1
 */
use Phalcon\Http\Request;

class MailController extends ControllerBase{

    public function indexController()
    {
        
    }
    
    /**
     * Metodo que permite enviar el mail
     */
    public function sendAction()
    {
        $this->view->disable();
        $request = new Request();
        if ($request->isPost() == true) {
            $send = $this->send( 
                array(
                    $request->getPost("email") => $request->getPost("email")
                ),
                $request->getPost("title"),
                'index',
                array(
                    'mail' => $request->getPost("email"),
                    'message' => $request->getPost("message"),
                )
            );
            if($send){
                $this->response->redirect();
            }
        }
    }
}