<?php
/**
 * @autor Sebastiao Junio Menezes Campos
 */

namespace SGS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
	
	public function onDispatch(MvcEvent $e) 
	{
		// Call the base class' onDispatch() first and grab the response
		$response = parent::onDispatch($e);        

		// Set alternative layout
		$this->layout()->setTemplate('layout/sgsLayout');                

		// Return the response
		return $response;
	}
	
    public function indexAction()
    {
		echo "teste";
		exit(1);
        return new ViewModel();
    }
}
