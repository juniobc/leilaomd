<?php
namespace SGS\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use SGS\Service\Autenticador;

class AuthenticationServiceFactory implements FactoryInterface{
	
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
		
        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new SessionStorage('Admin_Auth', 'session', $sessionManager);
        $authAdapter = $container->get(Autenticador::class);

        return new AuthenticationService($authStorage, $authAdapter);
    }
}