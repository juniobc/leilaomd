<?php

namespace SGS\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use SGS\Validator\UserExistsValidator;

class UsuarioForm extends Form{
	
	private $scenario;
	
	private $entityManager = null;
	
	private $user = null;
	
	public function __construct($scenario = 'criar', $entityManager = null, $user = null){
		
        parent::__construct('usuario_form');
     
        $this->setAttribute('method', 'post');
        
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->user = $user;
        
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
				'label_attributes' => array(
					'class' => 'col-xs-3',
				),
            ],
        ]);
		
		$this->add([            
            'type'  => 'email',
            'name' => 'email_usr',
			'attributes' => [
				'id' => 'email_usr',
				'maxlength' => '128',
				'class'=>'form-control', 
				'placeholder'=>'E-mail'
			],
            'options' => [
                'label' => 'E-mail',
				'label_attributes' => array(
					'class' => 'col-xs-3',
				),
            ],
        ]);
		
		$this->add([            
            'type'  => 'text',
            'name' => 'nm_usr',
			'attributes' => [
				'id' => 'nm_usr',
				'maxlength' => '150',
				'class'=>'form-control', 
				'placeholder'=>'Nome'
			],
            'options' => [
                'label' => 'Nome',
				'label_attributes' => array(
					'class' => 'col-xs-3',
				),
            ],
        ]);
		
		$this->add([            
            'type'  => 'text',
            'name' => 'sbr_nm_usr',
			'attributes' => [
				'id' => 'sbr_nm_usr',
				'class'=>'form-control', 
				'placeholder'=>'Sobrenome'
			],
            'options' => [
                'label' => 'Sobrenome',
				'label_attributes' => array(
					'class' => 'col-xs-3',
				),
            ],
        ]);
		
		$this->add([            
            'type'  => 'text',
            'name' => 'rg_usr',
			'attributes' => [
				'id' => 'rg_usr',
				'maxlength' => '8',
				'class'=>'form-control', 
				'placeholder'=>'Nº'
			],
            'options' => [
                'label' => 'RG',
				'label_attributes' => array(
					'class' => 'col-xs-3',
				),
            ],
        ]);
		
		$this->add([            
            'type'  => 'text',
            'name' => 'orgao_rg_usr',
			'attributes' => [
				'id' => 'orgao_rg_usr',
				'class'=>'form-control', 
				'placeholder'=>'Org.'
			]
        ]);
		
		$this->add([            
            'type'  => 'text',
            'name' => 'uf_rg_usr',
			'attributes' => [
				'id' => 'uf_rg_usr',
				'maxlength' => '2',
				'class'=>'form-control', 
				'placeholder'=>'UF'
			]
        ]);
		
		$this->add([            
            'type'  => 'select',
            'name' => 'sexo_usr',
			'attributes' => [
				'id' => 'sexo_usr',
				'maxlength' => '2',
				'class'=>'form-control'
			],
            'options' => [
                'label' => 'Sexo',
				'label_attributes' => array(
					'class' => 'col-xs-3',
				),
                'value_options' => [
                    0 => 'Masculino',
                    1 => 'Feminino',                    
                ]
            ],
        ]);
		
		if ($this->scenario == 'criar') {
        
            $this->add([            
                'type'  => 'password',
                'name' => 'senha_usr',
				'attributes' => [
					'id' => 'senha_usr',
					'class'=>'form-control', 
					'placeholder'=>'Senha'
				],
                'options' => [
                    'label' => 'Senha',
					'label_attributes' => array(
					'class' => 'col-xs-3',
				),
                ],
            ]);
            
            $this->add([            
                'type'  => 'password',
                'name' => 'confirm_senha_usr',
				'attributes' => [
					'id' => 'confirm_senha_usr',
					'class'=>'form-control', 
					'placeholder'=>'Confirme a senha'
				],
                'options' => [
                    'label' => 'Senha',
					'label_attributes' => array(
					'class' => 'col-xs-3',
				),
                ],
            ]);
			
        }
		
		$this->add([            
            'type'  => 'select',
            'name' => 'status_usr',
			'attributes' => [
				'id' => 'status_usr',
				'maxlength' => '2',
				'class'=>'form-control'
			],
            'options' => [
                'label' => 'Status',
				'label_attributes' => array(
					'class' => 'col-xs-3',
				),
                'value_options' => [
                    0 => 'Ativo',
                    1 => 'Inativo',                    
                ]
            ],
        ]);
		
		$this->add([
            'type'  => 'button',
            'name' => 'btn_registrar',
            'attributes' => [
                'id' => 'btn_registrar',
				'class' => "btn btn-primary btn-block btn-flat",
				'type' => 'submit'
            ],
			'options' => [
                'label' => 'Criar',
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
			'name'     => 'email_usr',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],   
				['name' => 'StringToUpper'],
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
						'max' => 128,
						'message' => 'Tamanho do campo inválido.'
					],
				],
				[
					'name' => 'EmailAddress',
					'options' => [
						'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
						'useMxCheck'    => true,
						'useDeepMxCheck'  => true                     
					],
				],
				/*[
					'name' => UserExistsValidator::class,
					'options' => [
						'entityManager' => $this->entityManager,
						'user' => $this->user
					],
				], */                   
			],
		]);
		
		$inputFilter->add([
			'name'     => 'nm_usr',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],    
				['name' => 'StringToUpper'],
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
						'max' => 150,
						'message' => 'Tamanho do campo inválido.'
					],
				]           
			],
		]);
		
		$inputFilter->add([
			'name'     => 'sbr_nm_usr',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],   
				['name' => 'StringToUpper'],
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
						'max' => 150,
						'message' => 'Tamanho do campo inválido.'
					],
				]           
			],
		]);
		
		$inputFilter->add([
			'name'     => 'rg_usr',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],    
				['name' => 'StringToUpper'],
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
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
						'max' => 8,
						'message' => 'Tamanho do campo inválido.'
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'uf_rg_usr',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],
				['name' => 'StringToUpper'],
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
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
						'max' => 2,
						'message' => 'Tamanho do campo inválido.'
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'orgao_rg_usr',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],   
				['name' => 'StringToUpper'],
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
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
						'max' => 20,
						'message' => 'Tamanho do campo inválido.'
					],
				],
			],
		]);
		
		if ($this->scenario == 'criar') {
            
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
				'name'     => 'confirm_senha_usr',
				'required' => true,
				'filters'  => [                        
				],                
				'validators' => [
					[
						'name'    => 'Identical',
						'options' => [
							'token' => 'senha_usr',                            
						],
					],
				],
			]);
        }
		
		$inputFilter->add([
			'name'     => 'status_usr',
			'required' => true,
			'filters'  => [                    
				['name' => 'ToInt'],
			],                
			'validators' => [
				['name'=>'InArray', 'options'=>['haystack'=>[0, 1]]]
			],
		]);      

		$inputFilter->add([
			'name'     => 'sexo_usr',
			'required' => true,
			'filters'  => [                    
				['name' => 'ToInt'],
			],                
			'validators' => [
				['name'=>'InArray', 'options'=>['haystack'=>[0, 1]]]
			],
		]); 
		
	}
	
}