<?php
/**
 * @autor Sebastiao Junio Menezes Campos
 */

namespace SGS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Application\Entity\Endereco\Pais;

class IndexController extends AbstractActionController
{
	private $entityManager;

	public function __construct($entityManager){
		
		$this->entityManager = $entityManager;
		
	}
	
    public function indexAction(){
		
        return new ViewModel();
    }
}
