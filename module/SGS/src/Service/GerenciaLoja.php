<?php
namespace SGS\Service;

use SGS\Entity\Endereco\Pais;
use SGS\Entity\Endereco\Estado;
use SGS\Entity\Endereco\Cidade;
use SGS\Entity\Endereco\Cep;
use SGS\Entity\Endereco\Endereco;

class GerenciaLoja{
	
	private $entityManager;
	 
	public function __construct($entityManager){
		
		$this->entityManager = $entityManager;
	
	}
	
	/*Cadastra estados e cidades no banco de dados
	
	public function addEndereco($data){
	
		$pais = $this->entityManager->getRepository(Pais::class)->findOneByCdPais(1);  
	
		foreach($data as $key=>$value){
		
			foreach($value as $x){
			
				$ufEstado = $x['sigla'];
				$nmEstado = $x['nome'];
				$cidades = $x['cidades'];
				
				$estado = new Estado();
				$estado->setPais($pais);
				$estado->setNmEstado(trim(strtoupper($x['nome'])));
				$estado->setUfEstado(trim(strtoupper($x['sigla'])));
				
				$this->entityManager->persist($estado);
				
				foreach($x['cidades'] as $cidade){
				
					$cidadeObj = new Cidade();
					$cidadeObj->setEstado($estado);
					$cidadeObj->setNmCidade(trim(strtoupper($cidade)));
					
					$this->entityManager->persist($cidadeObj);
				
				}
			
			}			
		}
		
		$pais = new Pais();
		$pais->setNmPais('BRASIL');
		
		$this->entityManager->persist($pais);*/
		
		
		
		/*$cep = new Cep();
		$cep->setCidade($cidade);
		$cep->setCdCep(74230025);
		$cep->setNmBairro('SETOR BUENO');
		$cep->setNmLogr('RUA T37');
		
		$this->entityManager->persist($cep);
		
		$endereco = new Endereco();
		$endereco->setCep($cep);
		$endereco->setDescComp('apto. 203 ed. joão paulo 2');
		$endereco->setNmQdr('Q 5');
		$endereco->setNmLote('L 3');
		$endereco->setNrLong(-16.7010093);
		$endereco->setNrLat(-49.2284037);
		
		$this->entityManager->persist($endereco);
		
		$this->entityManager->flush();
	
	}*/
	
	public function addLoja(){
		
		
		
	}
	
}