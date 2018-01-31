<?php
/**
 * @autor Sebastiao Junio Menezes Campos
 */
 
namespace SGS\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use SGS\Form\GrupoForm;
use Zend\View\Model\JsonModel;
use Zend\Validator\EmailAddress;
use Zend\Validator\Hostname;
use SGS\Entity\Grupo;

class GrupoController extends AbstractActionController{

    private $entityManager;
    private $gerenciaGrupo;
    
    public function __construct($entityManager, $gerenciaGrupo){
        $this->entityManager = $entityManager;
        $this->gerenciaGrupo = $gerenciaGrupo;
    }
	
    public function criarAction(){
		
		$form = new GrupoForm();
		
		if ($this->getRequest()->isPost()){
		
			try{
			
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
					
					$this->gerenciaGrupo->addGrupo($data);
					
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
		
		/*$grupos = $this->entityManager->getRepository(Grupo::class)->findBy([]);
		
		foreach ($grupos as $grupo){
		
			foreach($grupo->getEmails() as $email){
			
				echo $email->getEndEmail();
			
			}
		
		}*/
		
		//$query = $this->entityManager->createQuery('SELECT gpr FROM SGS\Entity\Grupo gpr');
		//$query->setParameter(1, 'romanb');

		//$teste = $query->getResult();
		
		/*var_dump($result);
		exit(1);*/
		
		//$grupos = $this->entityManager->getRepository(Grupo::class)->findOneById($postId);
		
        return new ViewModel([
			'form' => $form
		]);
    }
	
	public function alterarAction(){
	
		if ($this->getRequest()->isPost()){
		
			try{
			
				$form = new GrupoForm();
			
				$data = $this->params()->fromPost()['form_data'];
				
				$cdGrupo = $data['cd_grupo'];
				
				$grupo = $this->entityManager->getRepository(Grupo::class)->findOneByCdGpr($cdGrupo);  
				
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
					
					$this->gerenciaGrupo->updateGrupo($grupo, $data);
					
					return new JsonModel([
						'cd_msg' => '1',
						'desc_msg' => 'Grupo atualizado com sucesso.'
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
		
		return $this->redirect()->toRoute('grupo',['action'=>'criar']);
		
	}
	
	public function excluirAction(){
	
		if ($this->getRequest()->isPost()){
		
			try{
				
				$cdGrupo = (int)$this->params()->fromPost()['cd_grupo'];
								
				$grupo = $this->entityManager->getRepository(Grupo::class)->findOneByCdGpr($cdGrupo);
					
				$this->gerenciaGrupo->removeGrupo($grupo);
				
				return new JsonModel([
					'cd_msg' => '1',
					'desc_msg' => 'Grupo excluído com sucesso.'
				]);
			
			}catch (\Exception $e){
			
				return new JsonModel([
					'cd_msg' => '0',
					'desc_msg' => $e->getMessage()
				]);
			
			}
			
		}
	
		return $this->redirect()->toRoute('grupo',['action'=>'criar']);
	
	}
	
	public function buscarGrupoAction(){
	
		$grupo = $this->entityManager->getRepository(Grupo::class)->findOneByCdGpr($this->params()->fromPost()['cdGpr']);
		
		$grupoArray = [];
		$smpArray = [];
		$multArray= [];
		
		$grupoArray['cdGpr'] = $grupo->getCdGpr();
		$grupoArray['nmGpr'] = $grupo->getNmGpr();
		$grupoArray['descAtuaGpr'] = $grupo->getDescAtuaGpr();
		$grupoArray['descEmpresaGpr'] = $grupo->getDescEmpresaGpr();
		$grupoArray['descMissaoGpr'] = $grupo->getDescMissaoGpr();
		$grupoArray['descVisaoGpr'] = $grupo->getDescVisaoGpr();
		$grupoArray['descValorGpr'] = $grupo->getDescValorGpr();
		
		foreach($grupo->getTelefones() as $telefone){
		
			$smpArray['tpTel'] = $telefone->getTpTel();
			$smpArray['nrTel'] = $telefone->getDddTel().$telefone->getNrTel();
			$multArray[] = $smpArray ;
		
		}
		
		$grupoArray['telefones'] = $multArray;
		
		$smpArray = [];
		$multArray= [];
		
		foreach($grupo->getMidiasSocial() as $midia){
		
			$smpArray['linkMdSoc'] = $midia->getLinkMdSoc();
			$smpArray['descMdSoc'] = $midia->getDescMdSoc();
			$multArray[] = $smpArray ;
		
		}
		
		$grupoArray['midiasSocial'] = $multArray;
		
		$smpArray = [];
		$multArray= [];
		
		foreach($grupo->getEmails() as $email){
		
			$smpArray['cdEmail'] = $email->getCdEmail();
			$smpArray['descEmail'] = $email->getDescEmail();
			$smpArray['endEmail'] = $email->getEndEmail();
			$multArray[] = $smpArray ;
		
		}
		
		$grupoArray['emails'] = $multArray;
		
		return new JsonModel($grupoArray);
	
	}
	
	public function grupoJsonAction(){
	
		$grupos = $this->entityManager->getRepository(Grupo::class)->findBy([]);
		
		$grupoArray = [];
		$gruposArray = [];
		
		foreach ($grupos as $grupo){
		
			$grupoArray['cdGpr'] = $grupo->getCdGpr();
			$grupoArray['nmGpr'] = $grupo->getNmGpr();
			$grupoArray['descAtuaGpr'] = $grupo->getDescAtuaGpr();
		
			$gruposArray[] = $grupoArray;
		
		}
	
		return new JsonModel($gruposArray);
	
	}
}
