<?php

namespace SGS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tabela Telefone.
 * @ORM\Entity()
 * @ORM\Table(name="t008")
 */
class Telefone{
	
	/**
	* @ORM\Id
	* @ORM\Column(name="cd_gpr")
	*/
    protected $cdGpr;
	
	/**
	* @ORM\Id
	* @ORM\Column(name="cd_tel")
	*/
    protected $cdTel;
	
}