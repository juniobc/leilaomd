<?php

namespace SGS\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Tabela Midias Sociais.
 * @ORM\Entity()
 * @ORM\Table(name="t010")
 */
class MidiaSocial{
	
	/**
	* @ORM\Id
	* @ORM\Column(name="cd_md_soc")
	* @ORM\GeneratedValue
	*/
    protected $cdMdSoc;
	
	/** 
	* @ORM\Column(name="link_md_soc")  
	*/
    protected $linkMdSoc;
	
	/** 
	* @ORM\Column(name="desc_md_soc")  
	*/
    protected $descMdSoc;
	
	/**
	* @ORM\ManyToMany(targetEntity="\SGS\Entity\Grupo", mappedBy="midiasSocial")
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
	
	public function getCdMdSoc(){
		return $this->cdMdSoc;
	}
	
	public function setCdMdSoc($cdMdSoc){
		$this->cdMdSoc = $cdMdSoc;
	}
	
	public function getLinkMdSoc(){
		return $this->linkMdSoc;
	}
	
	public function setLinkMdSoc($linkMdSoc){
		$this->linkMdSoc = $linkMdSoc;
	}
	
	public function getDescMdSoc(){
		return $this->descMdSoc;
	}
	
	public function setDescMdSoc($descMdSoc){
		$this->descMdSoc = $descMdSoc;
	}
	
}