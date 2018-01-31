<?php
namespace SGS\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SGS\Service\GerenciaLoja;
use SGS\Controller\LojaController;

class LojaControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $gerenciaLoja = $container->get(GerenciaLoja::class);
        
        // Instantiate the controller and inject dependencies
        return new LojaController($entityManager, $gerenciaLoja);
    }
}