<?php

namespace SGS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\Result;
use Zend\Uri\Uri;
use SGS\Form\LoginForm;
use SGS\Form\UsuarioForm;
use SGS\Entity\Usuario;


class AutenticaController extends AbstractActionController{
	
	private $entityManager;	
	private $gerenciaAutenticador;
	private $gerenciaUsr;
	
	public function __construct($entityManager, $gerenciaAutenticador, $gerenciaUsr){
	
        $this->entityManager = $entityManager;
        $this->gerenciaAutenticador = $gerenciaAutenticador;
        $this->gerenciaUsr = $gerenciaUsr;
		
    }
	
	public function criarAdminAction(){
		
		$form = new UsuarioForm('criar');
		
		if ($this->getRequest()->isPost()) {
		
			try{
			
				$data = $this->params()->fromPost();
			
				$form->setData($data);
				
				if($form->isValid()) {
					
					$data = $form->getData();
					
					$user = $this->gerenciaUsr->addUser($data);
					
					return $this->redirect()->toRoute('login');
					
				}
			
			}catch (\Exception $e){
							
				$this->flashMessenger()->addErrorMessage($e->getMessage());
				//$this->flashMessenger()->addSuccessMessage($e->getMessage());
			
			}
			
			//var_dump($form->getMessages());
			
		}
		
		$this->layout()->setTemplate('layout/sgsLoginLayout');
		
		return new ViewModel(['form' => $form]);
	
	}
	
	public function loginAction(){
	
		try{
			
			$redirectUrl = (string)$this->params()->fromQuery('redirectUrl', '');
			if (strlen($redirectUrl)>2048) {
				throw new \Exception("URL do direcionamento é muito grande!");
			}
			
			$user = $this->entityManager->getRepository(Usuario::class)->findOneBy([]);
			
			if ($user==null) {
			
				return $this->redirect()->toRoute('criarAdmin');
			
			}
			
			$form = new LoginForm();
			$form->get('redireciona_url')->setValue($redirectUrl);
			
			$isLoginError = false;
			
			if ($this->getRequest()->isPost()) {
				
				$data = $this->params()->fromPost();
				
				$form->setData($data);
				
				if($form->isValid()) {
					
					$data = $form->getData();
					
					$result = $this->gerenciaAutenticador->login($data['cpf_usr'], $data['senha_usr'], $data['chk_lembrar']);
					//echo "teste";exit(1);
					if ($result->getCode() == Result::SUCCESS) {
						
						$redirectUrl = $this->params()->fromPost('redirect_url', '');
						
						if (!empty($redirectUrl)) {
							$uri = new Uri($redirectUrl);
							if (!$uri->isValid() || $uri->getHost()!=null)
								throw new \Exception('URL inválida: ' . $redirectUrl);
						}
						if(empty($redirectUrl)) {
							return $this->redirect()->toRoute('admin');
						} else {
							
							$this->redirect()->toUrl($redirectUrl);
						}
					
					}else {
						$isLoginError = true;
					}				
				}else{
					var_dump($form->getMessages());
					$isLoginError = true;
				}			
			}
		
		}catch (\Exception $e){
							
			$this->flashMessenger()->addErrorMessage($e->getMessage());
		
		}
		
		$this->layout()->setTemplate('layout/sgsLoginLayout');
		
		return new ViewModel([
            'form' => $form,
            'isLoginError' => $isLoginError,
            'redirectUrl' => $redirectUrl
        ]);
		
	}
	
	public function logoutAction(){
	
        $this->gerenciaAutenticador->logout();
        return $this->redirect()->toRoute('login');
		
    }
	
}
