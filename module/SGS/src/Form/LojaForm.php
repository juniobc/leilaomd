<?php
namespace SGS\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class LojaForm extends Form{

	public function __construct(){

		parent::__construct('loja_form');

		$this->setAttribute('method', 'post');

		$this->addElements();
		$this->addInputFilter();

	}
	
	protected function addElements(){
	
		$this->add([     
			'type'  => 'hidden',
			'name' => 'cd_loja',
			'attributes' => [
				'id' => 'cd_loja'
			]
		]);
		
		$this->add([     
			'type'  => 'text',
			'name' => 'nm_loja',
			'attributes' => [
				'id' => 'nm_loja',
				'maxlength' => '50',
				'class'=>'form-control', 
				'placeholder'=>'Nome da Loja'
			],
			'options' => [
			'label' => 'Nome da Loja',
			],
		]);
		
		$this->add([     
			'type'  => 'select',
			'name' => 'cd_estado',
			'attributes' => [
				'id' => 'cd_estado',
				'maxlength' => '50',
				'class'=>'form-control', 
				'placeholder'=>'Estado da Loja'
			],
			'options' => [
			'label' => 'Nome da Loja',
			'empty_option' => 'Informe um Estado',
			],
		]);
		
		$this->add([     
			'type'  => 'select',
			'name' => 'cd_cidade',
			'attributes' => [
				'id' => 'cd_cidade',
				'maxlength' => '50',
				'class'=>'form-control', 
				'placeholder'=>'Cidade da Loja'
			],
			'options' => [
			'label' => 'Nome da Loja',
			'empty_option' => 'Informe um Estado',
			],
		]);
		
		$this->add([     
			'type'  => 'text',
			'name' => 'desc_email',
			'attributes' => [
				'id' => 'desc_email',
				'maxlength' => '50',
				'class'=>'form-control', 
				'placeholder'=>'Descrição do E-mail'
			],
			'options' => [
			'label' => 'Descrição do E-mail',
			],
		]);
		
		$this->add([     
			'type'  => 'text',
			'name' => 'end_email',
			'attributes' => [
				'id' => 'end_email',
				'maxlength' => '100',
				'class'=>'form-control', 
				'placeholder'=>'E-mail'
			],
			'options' => [
			'label' => 'E-mail',
			],
		]);
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_atua_loja',
			'attributes' => [
				'id' => 'desc_atua_loja',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Atuação da Loja',
				'rows' => '3'
			],
			'options' => [
			'label' => 'Atuação da Loja',
			],
		]);
		
		$this->add([     
			'type'  => 'text',
			'name' => 'nr_tel_fixo',
			'attributes' => [
				'id' => 'nr_tel_fixo',
				'maxlength' => '17',
				'minlength' => '17',
				'class'=>'form-control',
				'data-inputmask' => '"mask":"(999) 9999-9999"',
				'data-mask' => ''
			],
			'options' => [
			'label' => 'Fixo',
			],
		]);
		
		$this->add([     
			'type'  => 'text',
			'name' => 'nr_tel_whats',
			'attributes' => [
				'id' => 'nr_tel_whats',
				'maxlength' => '19',
				'minlength' => '19',
				'class'=>'form-control',
				'data-inputmask' => '"mask":"(999) 9999-99999"',
				'data-mask' => ''
			],
			'options' => [
			'label' => 'WhatsApp',
			],
		]);
		
		$this->addElementMidia('link_facebook', 'Facebook', 'Link Facebook');
		$this->addElementMidia('link_instagram', 'Instagram', 'Link Instagram');
		$this->addElementMidia('link_google_plus', 'Google Plus', 'Link Google Plus');
		$this->addElementMidia('link_you_tube', 'You Tube', 'Link You Tube');
		$this->addElementMidia('link_pinterest', 'Pinterest', 'Link Pinterest');
		$this->addElementMidia('link_twitter', 'Twitter', 'Link Twitter');
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_empresa_loja',
			'attributes' => [
				'id' => 'desc_empresa_loja',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Empresa',
				'rows' => '3'
			],
			'options' => [
				'label' => 'Empresa',
			],
		]);
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_visao_loja',
			'attributes' => [
				'id' => 'desc_visao_loja',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Visão',
				'rows' => '3'
			],
			'options' => [
			'label' => 'Visão',
			],
		]);
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_missao_loja',
			'attributes' => [
				'id' => 'desc_missao_loja',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Missão',
				'rows' => '3'
			],
			'options' => [
			'label' => 'Missão',
			],
		]);
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_valor_loja',
			'attributes' => [
				'id' => 'desc_valor_loja',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Valor',
				'rows' => '3'
			],
			'options' => [
			'label' => 'Valor',
			],
		]);
	
	}
	
	private function addElementMidia($nome, $label, $placeholder){
		
		$this->add([     
			'type'  => 'text',
			'name' => "$nome",
			'attributes' => [
				'id' => "$nome",
				'maxlength' => '150',
				'class'=>'form-control', 
				'placeholder'=>"$placeholder"
			],
			'options' => [
				'label' => "$label",
				'label_attributes' => array(
					'class' => 'col-md-2',
				),
			],
		]);
		
	}
	
	protected function addInputFilter(){
	
		$inputFilter = new InputFilter();        
		$this->setInputFilter($inputFilter);
		
		$inputFilter->add([
			'name'     => 'nm_loja',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],                    
				['name' => 'StringToUpper'],                    
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
					'max' => 50
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'nr_tel_fixo',
			'required' => true,
			'filters'  => [
				['name' => 'Digits']                  
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'Digits',
					'name' => 'StringLength',
					'options' => [
					'min' => 11,
					'max' => 11
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'nr_tel_whats',
			'required' => true,
			'filters'  => [
				['name' => 'Digits']                  
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'Digits',
					'name' => 'StringLength',
					'options' => [
					'min' => 12,
					'max' => 12
					],
				],
			],
		]);
		
		$this->addInputFilterMidia($inputFilter, 'link_facebook');
		$this->addInputFilterMidia($inputFilter, 'link_instagram');
		$this->addInputFilterMidia($inputFilter, 'link_google_plus');
		$this->addInputFilterMidia($inputFilter, 'link_you_tube');
		$this->addInputFilterMidia($inputFilter, 'link_pinterest');
		$this->addInputFilterMidia($inputFilter, 'link_twitter');
		
		$inputFilter->add([
			'name'     => 'desc_empresa_loja',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],                    
				['name' => 'StringToUpper'],                    
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
					'max' => 255
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'desc_valor_loja',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],                    
				['name' => 'StringToUpper'],                    
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
					'max' => 255
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'desc_missao_loja',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],                    
				['name' => 'StringToUpper'],                    
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
					'max' => 255
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'desc_visao_loja',
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],                    
				['name' => 'StringToUpper'],                    
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
					'max' => 255
					],
				],
			],
		]);
	
	}
	
	private function addInputFilterMidia($inputFilter, $nome){
		
		$inputFilter->add([
			'name'     => "$nome",
			'required' => true,
			'filters'  => [
				['name' => 'StringTrim'],                    
				['name' => 'StringToUpper'],                    
				[
					'name' => 'UriNormalize'
				],                    
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
					'max' => 150
					],
					//'name' => 'Hostname',
				],
			],
		]);
		
	}


}
