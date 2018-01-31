<?php
/**
 * @autor Sebastiao Junio Menezes Campos
 */
 
namespace SGS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use SGS\Form\LojaForm;
use Zend\View\Model\JsonModel;
use Zend\Validator\EmailAddress;
use Zend\Validator\Hostname;
//use SGS\Entity\Grupo;
use Zend\Config\Reader\Json;

class LojaController extends AbstractActionController{

    private $entityManager;
    private $gerenciaLoja;
    
    public function __construct($entityManager, $gerenciaLoja){
        $this->entityManager = $entityManager;
        $this->gerenciaLoja = $gerenciaLoja;
	}
	
	public function gerenciarAction(){
	
		/*$reader = new Json();
		$data = $reader->fromFile('data/estados-cidades.json');*/
	
		//$this->gerenciaLoja->addLoja($data);
		
		$form = new LojaForm();
		
		return new ViewModel([
			'form' => $form
		]);
	
	}
	
	public function criarAction(){
	
		if ($this->getRequest()->isPost()){
		
			try{
			
				$form = new LojaForm();
			
				$data = $this->params()->fromPost()['form_data'];
				
				$validator = new EmailAddress([
					'allow' => Hostname::ALLOW_DNS,
					'mxCheck' => true,
					'deepMxCheck' => true
				]);
				
				$form->setData($data);
				
				if ($form->isValid()) {
									
					$data = $form->getData();
					
					foreach($this->params()->fromPost()['table_email_data'] as $key=>$value){
						if(!$validator->isValid($value['email'])) {
							return new JsonModel([
								'cd_msg' => '0',
								'desc_msg' => 'Email '.$value['email'].' invalido.'
							]);
						}
					}
					
					$data['email_data'] = $this->params()->fromPost()['table_email_data'];
					
					$this->gerenciaLoja->addLoja($data);
					
					return new JsonModel([
						'cd_msg' => '1',
						'desc_msg' => 'Grupo cadstrado com sucesso.'
					]);
					
				}else{
					
					$array = $form->getMessages();
					
					foreach($array as $key=>$value){
					
						$msg = "Problema no campo $key: ".array_values($value)[0];
					
					}
					
					return new JsonModel([
						'cd_msg' => '0',
						'desc_msg' => $msg
					]);
				
				}
			
			}catch (\Exception $e){
			
				return new JsonModel([
					'cd_msg' => '0',
					'desc_msg' => $e->getMessage()
				]);
			
			}
		
		}
	
		return $this->redirect()->toRoute('loja',['action'=>'gerenciar']);
	
	}

}