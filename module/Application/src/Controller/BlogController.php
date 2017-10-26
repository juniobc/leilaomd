<?php
/**
 * @author	Sebastião Junio Menezes Campos
 * @desc	Controller da página Blog
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class BlogController extends AbstractActionController
{
	
	/**
	  * @desc opens a modal window to display a message
	  * @param string $msg - the message to be displayed
	  * @return bool - success or failure
	*/
    public function indexAction()
    {
        return new ViewModel();
    }
	
	public function paginaAction()
    {
        return new ViewModel();
    }
}
