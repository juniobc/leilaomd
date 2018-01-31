<?php
namespace SGS\Entity\Endereco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tabela Estado.
 * @ORM\Entity
 * @ORM\Table(name="t002")
 */

class Estado{
	
	/**
	* @ORM\Id
	* @ORM\GeneratedValue
	* @ORM\Column(name="cd_estado")   
	*/
	protected $cdEstado;
	
	/**
	* @ORM\ManyToOne(targetEntity="\SGS\Entity\Endereco\Pais", inversedBy="estados")
    * @ORM\JoinColumn(name="cd_pais", referencedColumnName="cd_pais")
	*/
	protected $pais;
	
	/** 
	* @ORM\Column(name="nm_estado")  
	*/
	protected $nmEstado;
	
	/** 
	* @ORM\Column(name="uf_estado")  
	*/
	protected $ufEstado;
	
	/**
	* @ORM\OneToMany(targetEntity="\SGS\Entity\Endereco\Cidade", mappedBy="estado")
	* @ORM\JoinColumn(name="cd_estado", referencedColumnName="cd_estado")
	*/
	protected $cidades;
	
	public function __construct(){
        $this->cidades = new ArrayCollection();  
    }
	
	public function getCdEstado(){	
	
		return $this->cdEstado;		
		
	}
	
	public function setCdEstado($cdEstado){
		
		$this->cdEstado = $cdEstado;
		
	}
	
	public function getPais(){
	
		return $this->cdPais;		
		
	}
	
	public function setPais($pais){
		
		$this->pais = $pais;
		$pais->addEstado($this);
		
	}
	
	public function getNmEstado(){	
	
		return $this->nmEstado;		
		
	}
	
	public function setNmEstado($NmEstado){
		
		$this->nmEstado = $NmEstado;
		
	}
	
	public function getUfEstado(){	
	
		return $this->ufEstado;		
		
	}
	
	public function setUfEstado($ufEstado){
		
		$this->ufEstado = $ufEstado;
		
	}
	
	public function getCidades(){
        return $this->cidades;
    }
	
	public function addCidade($cidade){
        $this->cidades[] = $cidade;
    }
}