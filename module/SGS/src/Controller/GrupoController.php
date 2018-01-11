<?php
/**
 * @autor Sebastiao Junio Menezes Campos
 */

namespace SGS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use SGS\Form\GrupoForm;

class GrupoController extends AbstractActionController
{	
    public function criarAction()
    {
		
		$form = new GrupoForm();
		
        return new ViewModel([
			'form' => $form
		]);
    }
}
