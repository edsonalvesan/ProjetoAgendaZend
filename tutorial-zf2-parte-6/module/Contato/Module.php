<?php
/**
 * namespace para nosso modulo contato
 */
namespace Contato;

class Module
{
    /**
     * include de arquivo para outras configuracoes desse modulo
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * autoloader para nosso modulo
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    /**
     * Register View Helper
     */
    public function getViewHelperConfig()
    {
        return array(
            # registrar View Helper com injecao de dependecia
            'factories' => array(
                'menuAtivo'  => function($sm) {
                    return new View\Helper\MenuAtivo($sm->getServiceLocator()->get('Request'));
                },
                'message' => function($sm) {
                    return new View\Helper\Message($sm->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger'));
                },
            )
        );
    }
}
