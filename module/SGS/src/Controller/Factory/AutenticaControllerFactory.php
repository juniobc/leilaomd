<?php
	
namespace SGS\Controller\Factory;

use Interop\Container\ContainerInterface;
use SGS\Controller\AutenticaController;
use Zend\ServiceManager\Factory\FactoryInterface;
use SGS\Service\GerenciaAutenticador;
use SGS\Service\GerenciaUsuario;

class AutenticaControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authManager = $container->get(GerenciaAutenticador::class);
        $userManager = $container->get(GerenciaUsuario::class);
        return new AutenticaController($entityManager, $authManager, $userManager);
    }
}