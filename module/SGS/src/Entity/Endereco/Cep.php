<?php
namespace SGS\Entity\Endereco;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use SGS\Entity\Endereco\Endereco;

/**
 * Tabela Cep.
 * @ORM\Entity
 * @ORM\Table(name="t004")
 */

class Cep{
	
	/**
	* @ORM\Id
	* @ORM\Column(name="cd_cep")   
	*/
	protected $cdCep;
	
	/**
	* @ORM\ManyToOne(targetEntity="\SGS\Entity\Endereco\Cidade", inversedBy="ceps")
    * @ORM\JoinColumn(name="cd_cidade", referencedColumnName="cd_cidade")
	*/
	protected $cidade;
	
	/** 
	* @ORM\Column(name="nm_bairro")  
	*/
	protected $nmBairro;
	
	/** 
	* @ORM\Column(name="nm_logr")  
	*/
	protected $nmLogr;
	
	/**
	* @ORM\OneToMany(targetEntity="\SGS\Entity\Endereco\Endereco", mappedBy="cep")
	* @ORM\JoinColumn(name="cd_cep", referencedColumnName="cd_cep")
	*/
	protected $enderecos;
	
	public function __construct() {
		
		$this->enderecos = new ArrayCollection();
		
	}
	
	public function getCdCep(){	
	
		return $this->cdCep;		
		
	}
	
	public function setCdCep($cdCep){
		
		$this->cdCep = $cdCep;
		
	}
	
	public function getNmBairro(){	
	
		return $this->nmBairro;		
		
	}
	
	public function setNmBairro($nmBairro){
		
		$this->nmBairro = $nmBairro;
		
	}
	
	public function getNmLogr(){	
	
		return $this->nmLogr;		
		
	}
	
	public function setNmLogr($nmLogr){
		
		$this->nmLogr = $nmLogr;
		
	}
	
	public function getCidade() {
        return $this->cidade;
    }
	
	public function setCidade($cidade){
        $this->cidade = $cidade;
        $cidade->addCep($this);
    }
	
	public function getEnderecos(){
		
		return $this->enderecos;
	
	}
	
	public function addEndereco($endereco){
		
		$this->enderecos[] = $endereco;
		
	}
	
}