<?php
/**
 * @autor Sebastiao Junio Menezes Campos
 */

namespace SGS;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;
use SGS\Service\GerenciaAutenticador;
use SGS\Controller\AutenticaController;

class Module {
	
    public function init(ModuleManager $manager)
    {
		
        $eventManager = $manager->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
		
        $sharedEventManager->attach(__NAMESPACE__, 'dispatch', [$this, 'onDispatch'], 100);

    }
	
	public function onBootstrap(MvcEvent $event)
    {
	
        $eventManager = $event->getApplication()->getEventManager();
        $sharedEventManager = $eventManager->getSharedManager();
		
        $sharedEventManager->attach(AbstractActionController::class, 
                MvcEvent::EVENT_DISPATCH, [$this, 'onDispatch'], 100);
    }
	
    public function onDispatch(MvcEvent $event){
		
        $controller = $event->getTarget();
		$controllerName = $event->getRouteMatch()->getParam('controller', null);
		$actionName = $event->getRouteMatch()->getParam('action', null);
		
		$actionName = str_replace('-', '', lcfirst(ucwords($actionName, '-')));
		
		$authManager = $event->getApplication()->getServiceManager()->get(GerenciaAutenticador::class);
		
		if ($controllerName!=AutenticaController::class && !$authManager->filterAccess($controllerName, $actionName)) {
			
			$uri = $event->getApplication()->getRequest()->getUri();
			
			$uri->setScheme(null)
                ->setHost(null)
                ->setPort(null)
                ->setUserInfo(null);
            $redirectUrl = $uri->toString();
			
			return $controller->redirect()->toRoute('login', [], 
                    ['query'=>['redirectUrl'=>$redirectUrl]]);
		
		}
		
				
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
