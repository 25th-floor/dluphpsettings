<?php
namespace DluPhpSettings;

class Module
{
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * Configure PHP ini settings on the bootstrap event
     * @param \Zend\Mvc\MvcEvent $e
     */
    public function onBootstrap(\Zend\Mvc\MvcEvent $e) {
        $config         = $e->getParam('config');
        $phpSettings    = $config['phpSettings'];
        if($phpSettings) {
            foreach($phpSettings as $key => $value) {
                ini_set($key, $value);
            }
        }
    }
}
