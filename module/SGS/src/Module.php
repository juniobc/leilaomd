<?php
/**
 * @autor Sebastiao Junio Menezes Campos
 */

namespace SGS;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module {
	
    public function init(ModuleManager $manager)
    {
		
        $eventManager = $manager->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
		
        $sharedEventManager->attach(__NAMESPACE__, 'dispatch', [$this, 'onDispatch'], 100);
    }
	
    public function onDispatch(MvcEvent $event){
		
        $controller = $event->getTarget();
		
        $controllerClass = get_class($controller);
		
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
        
        if ($moduleNamespace == __NAMESPACE__) {
            $viewModel = $event->getViewModel();
            $viewModel->setTemplate('layout/sgsLayout');  
        }        
    }

    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}
