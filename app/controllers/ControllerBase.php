<?php
/**
 * Clase IndexController
 * 
 * Controlador base donde estan las funciones que usa la aplicación
 * 
 * @author Oscar Fernandez Alzate (oscarfdzalz@gmail.com)
 * @copyright Código Electrónica (codigoelectronica@gmail.com)
 * @version 1
 */
use Phalcon\Mvc\Controller;
use Phalcon\Mvc\User\Component;
use Phalcon\Mvc\View;

class ControllerBase extends Controller
{

    /**
     *Pernite obtener una vista para ser renderizada y mescasclada
     * 
     * @var string $name Nombre del archivo a renderizar
     * @var array $params array con los parametros que necesita la vista
     */
    public function getTemplate($name, $params)
    {
        $parameters = array_merge(array(
                'publicUrl' => $this->config->application->baseUri,
        ), $params);
        return $this->view->getRender('templatesemail', $name, $parameters, function($view){
                $view->setRenderLevel(View::LEVEL_LAYOUT);
        });
    }
    
    /**
     * Función que permite enviar el mail 
     * 
     * @param array $to Quien se envia el mail array('mail@mail.com'=>'usermail')
     * @param string $subject Titulo del mail
     * @param string $name Nombre del template que se va usar
     * @param array $params Parametros que usara el template
     * @return boolean Retorna 1 para true y 0 para false
     */
    public function send($to, $subject, $name, $params)
    {
        $mailSettings = $this->config->mail;
        $template = $this->getTemplate($name, $params);
        
        $message = Swift_Message::newInstance()
                ->setSubject($subject)
                ->setTo($to)
                ->setFrom(array(
                        $mailSettings->fromEmail => $mailSettings->fromName
                ))
                ->setBody($template, 'text/html');

            $transport = Swift_SmtpTransport::newInstance(
                $mailSettings->smtp->server,
                $mailSettings->smtp->port,
                $mailSettings->smtp->security
            )->setUsername($mailSettings->smtp->username)
            ->setPassword($mailSettings->smtp->password);
        
        $mailer = Swift_Mailer::newInstance($transport);
        return $mailer->send($message);
    }
}