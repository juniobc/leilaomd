<?php
namespace SGS\Entity\Endereco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SGS\Entity\Endereco\Cep;

/**
 * Tabela Cidade.
 * @ORM\Entity
 * @ORM\Table(name="t003")
 */

class Cidade{
	
	/**
	* @ORM\Id
	* @ORM\GeneratedValue
	* @ORM\Column(name="cd_cidade")   
	*/
	protected $cdCidade;
	
	/**
	* @ORM\ManyToOne(targetEntity="\SGS\Entity\Endereco\Estado", inversedBy="cidades")
    * @ORM\JoinColumn(name="cd_estado", referencedColumnName="cd_estado")
	*/
	protected $estado;
	
	/**
	* @ORM\OneToMany(targetEntity="\SGS\Entity\Endereco\Cep", mappedBy="cidade")
	* @ORM\JoinColumn(name="cd_cidade", referencedColumnName="cd_cidade")
	*/
	protected $ceps;
	
	/**
	* @ORM\Column(name="nm_cidade")  
	*/
	protected $nmCidade;
	
	public function __construct() {
		
		$this->ceps = new ArrayCollection();
		
	}
	
	public function getCdPais(){	
	
		return $this->cdPais;		
		
	}
	
	public function setCdPais($cdPais){
		
		$this->cdPais = $cdPais;
		
	}
	
	public function getNmCidade(){	
	
		return $this->nmCidade;		
		
	}
	
	public function setNmCidade($nmCidade){
		
		$this->nmCidade = $nmCidade;
		
	}
	
	public function getEstado() {
        return $this->estado;
    }
	
	public function setEstado($estado){
        $this->estado = $estado;
        $estado->addCidade($this);
    }
	
	public function getCeps(){
		
		return $this->ceps;
	
	}
	
	public function addCep($cep){
		
		$this->ceps[] = $cep;
		
	}
}