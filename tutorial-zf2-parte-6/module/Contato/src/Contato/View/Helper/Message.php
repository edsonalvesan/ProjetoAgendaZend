<?php

namespace Contato\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\Mvc\Controller\Plugin\FlashMessenger as FlashMessenger;

class Message extends AbstractHelper
{

    protected $flashMessenger;
    protected $message;

    public function __construct(FlashMessenger $flashMessenger)
    {
        $this->setFlashMessenger($flashMessenger);
        $this->setMessage();
    }

    public function __invoke()
    {
        return $this->renderHtml();
    }
    
    public function renderHtml()
    {
        $html = '';
        $message = $this->getMessage();
        
        if ($message) {
            $key   = key($message);
            $html .= '<div id="alert-message">';
                $html .= '<div class="'. $key . ' alert-block fade in">';
                    $html .= '<button type="button" class="close" data-dismiss="alert">&times;</button>';
                    $html .= $message[$key];
                $html .= '</div>';
            $html .= '</div>';
        }
        
        return $html;
    }

    public function getFlashMessenger()
    {
        return $this->flashMessenger;
    }

    public function setFlashMessenger($flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage()
    {
        $flashMessenger = $this->getFlashMessenger();

        if ($flashMessenger->hasMessages()) {
            $message = $flashMessenger->getMessages();
            $this->message = array('alert alert-warning' => array_shift($message));
        }
        
        if ($flashMessenger->hasInfoMessages()) {
            $messageInfo = $flashMessenger->getInfoMessages();
            $this->message = array('alert alert-info' => array_shift($messageInfo));
        }

        if ($flashMessenger->hasSuccessMessages()) {
            $messageSuccess = $flashMessenger->getSuccessMessages();
            $this->message = array('alert alert-success' => array_shift($messageSuccess));
        }

        if ($flashMessenger->hasErrorMessages()) {
            $messageError = $flashMessenger->getErrorMessages();
            $this->message = array('alert alert-danger' => array_shift($messageError));
        }
    }
}