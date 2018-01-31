<?php
namespace SGS\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SGS\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
		
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        
        return new IndexController($entityManager);
    }
}