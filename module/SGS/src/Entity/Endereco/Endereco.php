<?php
namespace SGS\Entity\Endereco;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tabela Cep.
 * @ORM\Entity
 * @ORM\Table(name="t005")
 */

class Endereco{
	
	/**
	* @ORM\Id
	* @ORM\GeneratedValue
	* @ORM\Column(name="cd_end")   
	*/
	protected $cdEnd;
	
	/**
	* @ORM\ManyToOne(targetEntity="\SGS\Entity\Endereco\Cep", inversedBy="enderecos")
    * @ORM\JoinColumn(name="cd_cep", referencedColumnName="cd_cep")
	*/
	protected $cep;
	
	/** 
	* @ORM\Column(name="desc_comp")  
	*/
	protected $descComp;
	
	/** 
	* @ORM\Column(name="nm_qdr")  
	*/
	protected $nmQdr;
	
	/** 
	* @ORM\Column(name="nm_lote")  
	*/
	protected $nmLote;
	
	/** 
	* @ORM\Column(name="nr_long")  
	*/
	protected $nrLong;
	
	/** 
	* @ORM\Column(name="nr_lat")  
	*/
	protected $nrLat;
	
	public function getCdEnd(){	
	
		return $this->cdEnd;		
		
	}
	
	public function setCdEnd($cdEnd){
		
		$this->cdEnd = $cdEnd;
		
	}
	
	public function getDescComp(){	
	
		return $this->descComp;		
		
	}
	
	public function setDescComp($descComp){
		
		$this->descComp = $descComp;
		
	}
	
	public function getNmQdr(){	
	
		return $this->nmQdr;		
		
	}
	
	public function setNmQdr($nmQdr){
		
		$this->nmQdr = $nmQdr;
		
	}
	
	public function getNmLote(){	
	
		return $this->nmLote;		
		
	}
	
	public function setNmLote($nmLote){
		
		$this->nmLote = $nmLote;
		
	}
	
	public function getNrLong(){	
	
		return $this->nrLong;		
		
	}
	
	public function setNrLong($nrLong){
		
		$this->nrLong = $nrLong;
		
	}
	
	public function getNrLat(){	
	
		return $this->nrLat;		
		
	}
	
	public function setNrLat($nrLat){
		
		$this->nrLat = $nrLat;
		
	}
	
	public function getCep(){
	
		return $this->cep;		
		
	}
	
	public function setCep($cep){
		
		$this->cep = $cep;
		$cep->addEndereco($this);
		
	}
	
}