<?php
namespace SGS\Service;

use Zend\Authentication\Result;

class GerenciaAutenticador{

    private $authService;
    
    private $sessionManager;

    private $config;

    public function __construct($authService, $sessionManager, $config) 
    {
        $this->authService = $authService;
        $this->sessionManager = $sessionManager;
        $this->config = $config;
    }
	
	public function login($email, $password, $rememberMe)
    {   
        if ($this->authService->getIdentity()!=null) {
            throw new \Exception('Usuário já esta logado');
        }
        
        $authAdapter = $this->authService->getAdapter();
        $authAdapter->setCpf($email);
        $authAdapter->setSenha($password);
        $result = $this->authService->authenticate();
		
		
		
        if ($result->getCode()==Result::SUCCESS && $rememberMe) {
            $this->sessionManager->rememberMe(60*60*24*30);
        }
        
        return $result;
    }
	
	public function logout(){
	
        // Allow to log out only when user is logged in.
        if ($this->authService->getIdentity()==null) {
            throw new \Exception('Usuário não está logado');
        }
        
        // Remove identity from session.
        $this->authService->clearIdentity();               
    }
	
	public function filterAccess($controllerName, $actionName)
    {
        // Determine mode - 'restrictive' (default) or 'permissive'. In restrictive
        // mode all controller actions must be explicitly listed under the 'access_filter'
        // config key, and access is denied to any not listed action for unauthorized users. 
        // In permissive mode, if an action is not listed under the 'access_filter' key, 
        // access to it is permitted to anyone (even for not logged in users.
        // Restrictive mode is more secure and recommended to use.
        $mode = isset($this->config['options']['mode'])?$this->config['options']['mode']:'restrictive';
        if ($mode!='restrictive' && $mode!='permissive')
            throw new \Exception('Filtro de acesso inválido (Restrictive ou Permissive)');
        
        if (isset($this->config['controllers'][$controllerName])) {
            $items = $this->config['controllers'][$controllerName];
            foreach ($items as $item) {
                $actionList = $item['actions'];
                $allow = $item['allow'];
                if (is_array($actionList) && in_array($actionName, $actionList) ||
                    $actionList=='*') {
                    if ($allow=='*')
                        return true; // Anyone is allowed to see the page.
                    else if ($allow=='@' && $this->authService->hasIdentity()) {
                        return true; // Only authenticated user is allowed to see the page.
                    } else {                    
                        return false; // Access denied.
                    }
                }
            }            
        }
        
        // In restrictive mode, we forbid access for unauthorized users to any 
        // action not listed under 'access_filter' key (for security reasons).
        if ($mode=='restrictive' && !$this->authService->hasIdentity())
            return false;
        
        // Permit access to this page.
        return true;
    }
	
}