<?php
namespace SGS\Service;
use SGS\Entity\Usuario;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;


class GerenciaUsuario{
	
	private $entityManager;
	 
	public function __construct($entityManager){
		
		$this->entityManager = $entityManager;
	
	}
	
	public function addUser($data){
		
		if($this->checkUserExists($data['cpf_usr'])) {
			throw new \Exception("CPF já cadastrado!");
		}
		
		if($this->checkUserEmailExists($data['email_usr'])) {
			throw new \Exception("E-mail já cadastrado!");
		}

		$user = new Usuario();
		$user->setCPF($data['cpf_usr']);
		$user->setEmail($data['email_usr']);
		$user->setNome($data['nm_usr']);
		$user->setSobreNome($data['sbr_nm_usr']);
		$user->setRg($data['rg_usr']);
		$user->setUfRg($data['uf_rg_usr']);
		$user->setOrgaoRg($data['orgao_rg_usr']);
		$user->setSexo($data['sexo_usr']);
		$user->setCPF($data['cpf_usr']);    
		
		$bcrypt = new Bcrypt();
		$passwordHash = $bcrypt->create($data['senha_usr']);        
		$user->setSenha($passwordHash);

		$user->setStatus($data['status_usr']);

		$currentDate = date('Y-m-d H:i:s');
		$user->setDataCriacao($currentDate);        
		$user->setDataAtualiza($currentDate);        
		//$user->setEndereco(0);        

		$this->entityManager->persist($user);

		$this->entityManager->flush();

		return $user;
	
	}
	
	public function checkUserExists($cpf) {
        
        $user = $this->entityManager->getRepository(Usuario::class)->findOneByCpf($cpf);
        
        return $user !== null;
    }
	
	public function checkUserEmailExists($email) {
        
        $user = $this->entityManager->getRepository(Usuario::class)->findOneByEmail($email);
        
        return $user !== null;
    }
	
}