<?php
namespace SGS\Validator;
use Zend\Validator\AbstractValidator;
use SGS\Entity\Usuario;

class UserExistsValidator extends AbstractValidator 
{

    protected $options = array(
        'entityManager' => null,
        'user' => null
    );
    
    const NOT_SCALAR  = 'notScalar';
    const USER_CPF_EXISTS = 'cpfExiste';
    const USER_EMAIL_EXISTS = 'emailExiste';
        
    protected $messageTemplates = array(
        self::NOT_SCALAR  => "Valor do campo invalido",
        self::USER_CPF_EXISTS  => "CPF já cadastrado",
        self::USER_EMAIL_EXISTS  => "E-mail já cadastrado"		
    );
	
    public function __construct($options = null){
		
        if(is_array($options)) {            
            if(isset($options['entityManager']))
                $this->options['entityManager'] = $options['entityManager'];
            if(isset($options['user']))
                $this->options['user'] = $options['user'];
        }
        
        parent::__construct($options);

    }
        
    /**
     * Check if user exists.
     */
    public function isValid($value) 
    {
        if(!is_scalar($value)) {
            $this->error(self::NOT_SCALAR);
            return false; 
        }
        
        // Get Doctrine entity manager.
        $entityManager = $this->options['entityManager'];
        
        $user_mail = $entityManager->getRepository(Usuario::class)->findOneByEmail($value);
        
        if($this->options['user']==null) {
            $isValid = ($user_mail==null);
        } else {
            if($this->options['user']->getEmail()!=$value && $user_mail!=null) 
                $isValid = false;
            else 
                $isValid = true;
        }
        
        // If there were an error, set error message.
        if(!$isValid) {            
            $this->error(self::USER_EMAIL_EXISTS);            
        }
		
		$user_cpf = $entityManager->getRepository(Usuario::class)->findOneByCPF($value);
        
        if($this->options['user']==null) {
            $isValid = ($user_cpf==null);
        } else {
            if($this->options['user']->getCPF()!=$value && $user_cpf!=null) 
                $isValid = false;
            else 
                $isValid = true;
        }
        
        // If there were an error, set error message.
        if(!$isValid) {            
            $this->error(self::USER_CPF_EXISTS);            
        }
        
        // Return validation result.
        return $isValid;
    }
}