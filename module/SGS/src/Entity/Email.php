<?php

namespace SGS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tabela Midias Sociais.
 * @ORM\Entity()
 * @ORM\Table(name="t012")
 */
class Email{
	
	/**
	* @ORM\Id
	* @ORM\Column(name="cd_email")
	* @ORM\GeneratedValue
	*/
    protected $cdEmail;
	
	/** 
	* @ORM\Column(name="desc_email")  
	*/
    protected $descEmail;
	
	/** 
	* @ORM\Column(name="end_email")  
	*/
    protected $endEmail;
	
	/**
	* @ORM\ManyToMany(targetEntity="\SGS\Entity\Grupo", mappedBy="emails")
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
	
	public function getCdEmail(){
		return $this->cdEmail;
	}
	
	public function setCdEmail($cdEmail){
		$this->cdEmail = $cdEmail;
	}
	
	public function getDescEmail(){
		return $this->descEmail;
	}
	
	public function setDescEmail($descEmail){
		$this->descEmail = $descEmail;
	}
	
	public function getEndEmail(){
		return $this->endEmail;
	}
	
	public function setEndEmail($endEmail){
		$this->endEmail = $endEmail;
	}
	
}