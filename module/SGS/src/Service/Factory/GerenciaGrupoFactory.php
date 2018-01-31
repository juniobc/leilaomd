<?php
namespace SGS\Service\Factory;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SGS\Service\GerenciaGrupo;

class GerenciaGrupoFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null){
        
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
                        
        return new GerenciaGrupo($entityManager);
    }
}