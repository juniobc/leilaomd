<?php

namespace SGS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tabela Grupo.
 * @ORM\Entity()
 * @ORM\Table(name="t007")
 */
class Grupo{
	
	/**
	* @ORM\Id
	* @ORM\Column(name="cd_gpr")
	* @ORM\GeneratedValue
	*/
    protected $cdGpr;
	
	/** 
	* @ORM\Column(name="nm_gpr")  
	*/
    protected $nmGpr;
	
	/** 
	* @ORM\Column(name="desc_atua_gpr")  
	*/
    protected $descAtuaGpr;
	
	/** 
	* @ORM\Column(name="desc_empresa_gpr")  
	*/
    protected $descEmpresaGpr;
	
	/** 
	* @ORM\Column(name="desc_missao_gpr")  
	*/
    protected $descMissaoGpr;
	
	/** 
	* @ORM\Column(name="desc_visao_gpr")  
	*/
    protected $descVisaoGpr;	
	
	/** 
	* @ORM\Column(name="desc_valor_gpr")  
	*/
    protected $descValorGpr;
	
	/**
	* @ORM\ManyToMany(targetEntity="\SGS\Entity\Telefone", inversedBy="grupos")
	* @ORM\JoinTable(name="t009",
	*      joinColumns={@ORM\JoinColumn(name="cd_gpr", referencedColumnName="cd_gpr")},
	*      inverseJoinColumns={@ORM\JoinColumn(name="cd_tel", referencedColumnName="cd_tel")}
	* )
	*/
	protected $telefones;
	
	/**
	* @ORM\ManyToMany(targetEntity="\SGS\Entity\MidiaSocial", inversedBy="grupos")
	* @ORM\JoinTable(name="t011",
	*      joinColumns={@ORM\JoinColumn(name="cd_gpr", referencedColumnName="cd_gpr")},
	*      inverseJoinColumns={@ORM\JoinColumn(name="cd_md_soc", referencedColumnName="cd_md_soc")}
	* )
	*/
	protected $midiasSocial;
	
	/**
	* @ORM\ManyToMany(targetEntity="\SGS\Entity\Email", inversedBy="grupos")
	* @ORM\JoinTable(name="t013",
	*      joinColumns={@ORM\JoinColumn(name="cd_gpr", referencedColumnName="cd_gpr")},
	*      inverseJoinColumns={@ORM\JoinColumn(name="cd_email", referencedColumnName="cd_email")}
	* )
	*/
	protected $emails;
	
	public function __construct(){ 
	
		$this->telefones = new ArrayCollection();
		$this->midiasSocial = new ArrayCollection();
		$this->emails = new ArrayCollection();
		
	}
	
	public function getEmails(){
		
		return $this->emails;
	}
	
	public function addEmail($email){
		
		$this->emails[] = $email;     
		
	}
	
	public function removeEmailAssociation($email){
		
		$this->emails->removeElement($email);
		
	}
	
	public function getTelefones(){
		
		return $this->telefones;
	}  
	
	public function addTelefone($telefone){
		
		$this->telefones[] = $telefone;     
		
	}
	
	public function removeTelefoneAssociation($telefone){
		
		$this->telefones->removeElement($telefone);
		
	}
	
	public function getMidiasSocial(){
		
		return $this->midiasSocial;
	}  
	
	public function addMidiaSocial($midiaSocial){
		
		$this->midiasSocial[] = $midiaSocial;     
		
	}
	
	public function removeMidiaSocialAssociation($midiaSocial){
		
		$this->midiasSocial->removeElement($midiaSocial);
		
	}
	
	public function getCdGpr(){
		return $this->cdGpr;
	}
	
	public function setCdGpr($cdGpr){
		$this->cdGpr = $cdGpr;
	}
	
	public function getNmGpr(){
		return $this->nmGpr;
	}
	
	public function setNmGpr($nmGpr){
		$this->nmGpr = $nmGpr;
	}
	
	public function getDescAtuaGpr(){
		return $this->descAtuaGpr;
	}
	
	public function setDescAtuaGpr($descAtuaGpr){
		$this->descAtuaGpr = $descAtuaGpr;
	}
	
	public function getDescEmpresaGpr(){
		return $this->descEmpresaGpr;
	}
	
	public function setDescEmpresaGpr($descEmpresaGpr){
		$this->descEmpresaGpr = $descEmpresaGpr;
	}
	
	public function getDescMissaoGpr(){
		return $this->descMissaoGpr;
	}
	
	public function setDescMissaoGpr($descMissaoGpr){
		$this->descMissaoGpr = $descMissaoGpr;
	}
	
	public function getDescVisaoGpr(){
		return $this->descVisaoGpr;
	}
	
	public function setDescVisaoGpr($descVisaoGpr){
		$this->descVisaoGpr = $descVisaoGpr;
	}
	
	public function getDescValorGpr(){
		return $this->descValorGpr;
	}
	
	public function setDescValorGpr($descValorGpr){
		$this->descValorGpr = $descValorGpr;
	}
	
}