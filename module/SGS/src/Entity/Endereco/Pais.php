<?php
namespace SGS\Entity\Endereco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SGS\Entity\Endereco\Estado;

/**
 * Tabela Pais.
 * @ORM\Entity
 * @ORM\Table(name="t001")
 */

class Pais{
	
	/**
	* @ORM\Id
	* @ORM\GeneratedValue
	* @ORM\Column(name="cd_pais")   
	*/
	protected $cdPais;
	
	/** 
	* @ORM\Column(name="nm_pais")  
	*/
	protected $nmPais;
	
	/**
	* @ORM\OneToMany(targetEntity="\SGS\Entity\Endereco\Estado", mappedBy="pais")
	* @ORM\JoinColumn(name="cd_pais", referencedColumnName="cd_pais")
	*/
	protected $estados;
	
	public function __construct() {
		
		$this->estados = new ArrayCollection();
		
	}
	
	public function getCdPais(){	
	
		return $this->cdPais;		
		
	}
	
	public function setCdPais($cdPais){
		
		$this->cdPais = $cdPais;
		
	}
	
	public function getNmPais(){	
	
		return $this->nmPais;		
		
	}
	
	public function setNmPais($nmPais){
		
		$this->nmPais = $nmPais;
		
	}
	
	public function getEstados(){
		
		return $this->estados;
	
	}
	
	public function addEstado($estado){
		
		$this->estados[] = $estado;
		
	}
}