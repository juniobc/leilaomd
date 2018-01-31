<?php

namespace SGS\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="t006")
 */
class Usuario{
	
	const STATUS_ATIVO = 1;
    const STATUS_INATIVO = 2;
	
	/**
	* @ORM\Id
	* @ORM\Column(name="cpf_usr")
	*/
    protected $cpf;
	
	/** 
	* @ORM\Column(name="email_usr")  
	*/
    protected $email;
	
	/** 
	* @ORM\Column(name="nm_usr")  
	*/
    protected $nome;
	
	/** 
	* @ORM\Column(name="sbr_nm_usr")  
	*/
    protected $sobreNome;
	
	/** 
	* @ORM\Column(name="rg_usr")  
	*/
    protected $rg;
	
	/** 
	* @ORM\Column(name="uf_rg_usr")  
	*/
    protected $ufRg;
	
	/** 
	* @ORM\Column(name="orgao_rg_usr")  
	*/
    protected $orgaoRg;
	
	/** 
	* @ORM\Column(name="sexo_usr")  
	*/
    protected $sexo;
	
	/** 
	* @ORM\Column(name="senha_usr")  
	*/
    protected $senha;
	
	/** 
	* @ORM\Column(name="status_usr")  
	*/
    protected $status;
	
	/** 
	* @ORM\Column(name="dt_criacao_usr")  
	*/
    protected $dataCriacao;
	
	/** 
	* @ORM\Column(name="dt_atual_usr")  
	*/
    protected $dataAtualiza;
	
	/** 
	* @ORM\Column(name="senha_reset_token")  
	*/
    protected $senhaResetToken;
	
	/** 
	* @ORM\Column(name="senha_reset_token_date")  
	*/
    protected $dataToken;
	
	/** 
	* @ORM\Column(name="cd_end")  
	*/
    //protected $endereco;
	
	public function getCpf(){
		return $this->cpf;
	}
	
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getSobreNome(){
		return $this->sobreNome;
	}
	
	public function setSobreNome($sobreNome){
		$this->sobreNome = $sobreNome;
	}
	
	public function getRg(){
		return $this->rg;
	}
	
	public function setRg($rg){
		$this->rg = $rg;
	}
	
	public function getUfRg(){
		return $this->ufRg;
	}
	
	public function setUfRg($ufRg){
		$this->ufRg = $ufRg;
	}
	
	public function getOrgaoRg(){
		return $this->orgaoRg;
	}
	
	public function setOrgaoRg($orgaoRg){
		$this->orgaoRg = $orgaoRg;
	}
	
	public function getSexo(){
		return $this->sexo;
	}
	
	public function setSexo($sexo){
		$this->sexo = $sexo;
	}
	
	public function getSenha(){
		return $this->senha;
	}
	
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public static function getStatusList() 
    {
        return [
            self::STATUS_ATIVO => 'Ativo',
            self::STATUS_INATIVO => 'Inativo'
        ];
    }
	
	public function getStatusAsString(){
		
        $list = self::getStatusList();
        if (isset($list[$this->status]))
            return $list[$this->status];
        
        return 'Desconhecido';
    }
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getDataCriacao(){
		return $this->dataCriacao;
	}
	
	public function setDataCriacao($dataCriacao){
		$this->dataCriacao = $dataCriacao;
	}
	
	public function getDataAtualiza(){
		return $this->dataAtualiza;
	}
	
	public function setDataAtualiza($dataAtualiza){
		$this->dataAtualiza = $dataAtualiza;
	}
	
	public function getSenhaResetToken(){
		return $this->senhaResetToken;
	}
	
	public function setSenhaResetToken($senhaResetToken){
		$this->senhaResetToken = $senhaResetToken;
	}
	
	public function getDataToken(){
		return $this->dataToken;
	}
	
	public function setDataToken($dataToken){
		$this->dataToken = $dataToken;
	}
	
	/*public function getEndereco(){
		return $this->endereco;
	}
	
	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}*/
	
} 