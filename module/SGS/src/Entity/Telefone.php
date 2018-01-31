<?php

namespace SGS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tabela Telefone.
 * @ORM\Entity()
 * @ORM\Table(name="t008")
 */
class Telefone{
	
	/**
	* @ORM\Id
	* @ORM\Column(name="cd_tel")
	* @ORM\GeneratedValue
	*/
    protected $cdTel;
	
	/** 
	* @ORM\Column(name="nm_tel")  
	*/
    protected $nmTel;	
	
	/** 
	* @ORM\Column(name="tp_tel")  
	*/
    protected $tpTel;
	
	/** 
	* @ORM\Column(name="ddd_tel")  
	*/
    protected $dddTel;
	
	/** 
	* @ORM\Column(name="nr_tel")  
	*/
    protected $nrTel;
	
	/**
	* @ORM\ManyToMany(targetEntity="\SGS\Entity\Grupo", mappedBy="telefones")
	*/
	protected $grupos;
	
	public function __construct(){        
		$this->grupos = new ArrayCollection();        
	}
	
	public function getGrupos(){
		return $this->grupos;
	}
	
	public function addGrupo($grupo){
		$this->grupos[] = $grupo;        
	}
	
	public function getCdTel(){
		return $this->cdTel;
	}
	
	public function setCdTel($cdTel){
		$this->cdTel = $cdTel;
	}
	
	public function getNmTel(){
		return $this->nmTel;
	}
	
	public function setNmTel($nmTel){
		$this->nmTel = $nmTel;
	}
	
	public function getTpTel(){
		return $this->tpTel;
	}
	
	public function setTpTel($tpTel){
		$this->tpTel = $tpTel;
	}
	
	public function getDddTel(){
		return $this->dddTel;
	}
	
	public function setDddTel($dddTel){
		$this->dddTel = $dddTel;
	}
	
	public function getNrTel(){
		return $this->nrTel;
	}
	
	public function setNrTel($nrTel){
		$this->nrTel = $nrTel;
	}
}