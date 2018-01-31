<?php
namespace SGS\Service\Factory;
use Interop\Container\ContainerInterface;
use SGS\Service\Autenticador;
use Zend\ServiceManager\Factory\FactoryInterface;


class AutenticadorFactory implements FactoryInterface
{
	
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){        
	
        $entityManager = $container->get('doctrine.entitymanager.orm_default');        
                        
        return new Autenticador($entityManager);
		
    }
}