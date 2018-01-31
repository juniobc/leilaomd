<?php
namespace SGS\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SGS\Service\GerenciaGrupo;
use SGS\Controller\GrupoController;

class GrupoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $gerenciaGrupo = $container->get(GerenciaGrupo::class);
        
        // Instantiate the controller and inject dependencies
        return new GrupoController($entityManager, $gerenciaGrupo);
    }
}