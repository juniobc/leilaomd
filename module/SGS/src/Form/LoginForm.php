<?php

namespace SGS\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;

class LoginForm extends Form{
	
	public function __construct(){
		
        parent::__construct('login_form');
     
        $this->setAttribute('method', 'post');
                
        $this->addElements();
        $this->addInputFilter();          
    }
	
	protected function addElements(){
		
		$this->add([            
            'type'  => 'text',
            'name' => 'cpf_usr',
			'attributes' => [
				'id' => 'cpf_usr',
				'maxlength' => '11',
				'class'=>'form-control', 
				'placeholder'=>'CPF'
			],
            'options' => [
                'label' => 'CPF',
            ],
        ]);
		
		$this->add([            
            'type'  => 'password',
            'name' => 'senha_usr',
			'attributes' => [
				'id' => 'senha_usr',
				'maxlength' => '20',
				'class'=>'form-control',
				'placeholder'=>'Senha'
			],
            'options' => [
                'label' => 'Senha',
            ],
        ]);
		
		$this->add([            
            'type'  => 'checkbox',
            'name' => 'chk_lembrar',
            'options' => [
                'label' => 'Lembrar',
            ],
        ]);
		
		$this->add([            
            'type'  => 'hidden',
            'name' => 'redireciona_url'
        ]);
		
		$this->add([
            'type' => 'csrf',
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
					'timeout' => 600
                ]
            ],
        ]);
		
		$this->add([
            'type'  => 'button',
            'name' => 'btn_login',
            'attributes' => [
                'id' => 'btn_login',
				'class' => "btn btn-primary btn-block btn-flat",
				'type' => 'submit'
            ],
			'options' => [
                'label' => 'Entrar',
            ],
        ]);
		
	}
	
	private function addInputFilter(){
		
		$inputFilter = new InputFilter();        
        $this->setInputFilter($inputFilter);
		
		$inputFilter->add([
			'name'     => 'cpf_usr',
			'filters'  => [
				['name' => 'StringTrim'],                    
			],              
			'validators' => [
				[
					'name' => 'NotEmpty',
					'breakChainOnFailure' => true,
					'options' => [
						'message' => 'Este campo não pode ser vazio.'
					]
				],
				[
					'name' => 'Digits',
					'breakChainOnFailure' => true,
					'options' => [
						'message' => 'Informe somente números.'
					]
				],
				[
					'name' => 'StringLength',
					'breakChainOnFailure' => true,
					'options' => [
						'min' => 11,
						'max' => 11,
						'message' => 'Tamanho do campo inválido.'
					],
				]
			],
		]);
		
		$inputFilter->add([
			'name'     => 'senha_usr',
			'required' => true,
			'filters'  => [                        
			],                
			'validators' => [
				[
					'name' => 'NotEmpty',
					'breakChainOnFailure' => true,
					'options' => [
						'message' => 'Este campo não pode ser vazio.'
					]
				],
				[
					'name'    => 'StringLength',
					'options' => [
						'min' => 6,
						'max' => 64,
						'message' => 'Tamanho do campo inválido.'
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'chk_lembrar',
			'required' => false,
			'filters'  => [                    
			],                
			'validators' => [
				[
					'name'    => 'InArray',
					'options' => [
						'haystack' => [0, 1],
					]
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'redireciona_url',
			'required' => false,
			'filters'  => [
				['name'=>'StringTrim']
			],                
			'validators' => [
				[
					'name'    => 'StringLength',
					'options' => [
						'min' => 0,
						'max' => 2048,
						'message' => 'Tamanho do campo inválido.'
					]
				],
			],
		]);
		
	}
	
}