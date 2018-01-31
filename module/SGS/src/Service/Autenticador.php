<?php

namespace SGS\Service;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use SGS\Entity\Usuario;


class Autenticador implements AdapterInterface{
	
	private $cpf;
	private $senha;
	private $entityManager;
	
	public function __construct($entityManager){
		
        $this->entityManager = $entityManager;
    }
	
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function authenticate(){
		
		$user = $this->entityManager->getRepository(Usuario::class)->findOneByCpf($this->cpf);
		
		if ($user==null) {
            return new Result(
                Result::FAILURE_IDENTITY_NOT_FOUND, 
                null,
                ['Usuário ou senha invalido.']
			);
        }

		if ($user->getStatus()==Usuario::STATUS_INATIVO) {
            return new Result(
                Result::FAILURE, 
                null, 
                ['Usuário inativo.']
			);        
        }
		
		$bcrypt = new Bcrypt();
        $passwordHash = $user->getSenha();
		
		if ($bcrypt->verify($this->senha, $passwordHash)) {
            return new Result(
				Result::SUCCESS, 
				$this->cpf, 
				['Acesso concedido.']
			);
        }
		
		return new Result(
			Result::FAILURE_CREDENTIAL_INVALID, 
			null, 
			['Usuário ou senha invalido.']
		);
		
	}
	
}