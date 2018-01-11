<?php
namespace SGS\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class GrupoForm extends Form{

	public function __construct(){

		parent::__construct('grupo_form');

		$this->setAttribute('method', 'post');

		$this->addElements();
		$this->addInputFilter();

	}

	protected function addElements(){

		$this->add([     
			'type'  => 'text',
			'name' => 'nm_grupo',
			'attributes' => [
				'id' => 'nm_grupo',
				'maxlength' => '50',
				'class'=>'form-control', 
				'placeholder'=>'Nome do Grupo'
			],
			'options' => [
			'label' => 'Nome do Grupo',
			],
		]);
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_atua_gpr',
			'attributes' => [
				'id' => 'desc_atua_gpr',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Atuação do Grupo',
				'rows' => '3'
			],
			'options' => [
			'label' => 'Descrição',
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
				'maxlength' => '18',
				'minlength' => '18',
				'class'=>'form-control',
				'data-inputmask' => '"mask":"(999) 9999-9999"',
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
			'name' => 'desc_empresa_gpr',
			'attributes' => [
				'id' => 'desc_empresa_gpr',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Atuação do Grupo',
				'rows' => '3'
			],
			'options' => [
				'label' => 'Empresa',
			],
		]);
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_visao_gpr',
			'attributes' => [
				'id' => 'desc_visao_gpr',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Atuação do Grupo',
				'rows' => '3'
			],
			'options' => [
			'label' => 'Visão',
			],
		]);
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_missao_gpr',
			'attributes' => [
				'id' => 'desc_missao_gpr',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Atuação do Grupo',
				'rows' => '3'
			],
			'options' => [
			'label' => 'Missão',
			],
		]);
		
		$this->add([     
			'type'  => 'textarea',
			'name' => 'desc_valor_gpr',
			'attributes' => [
				'id' => 'desc_valor_gpr',
				'maxlength' => '255',
				'class'=>'form-control', 
				'placeholder'=>'Atuação do Grupo',
				'rows' => '3'
			],
			'options' => [
			'label' => 'Valor',
			],
		]);
		
		$this->add([
			'type'  => 'file',
			'name' => 'file',
			'attributes' => [                
				'id' => 'file'
			],
			'options' => [
				'label' => 'Image file',
			],
		]);
		

	}
	
	private function addElementMidia($nome, $label, $placeholder){
		
		$this->add([     
			'type'  => 'text',
			'name' => "$nome",
			'attributes' => [
				'id' => 'nm_grupo',
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
			'name'     => 'nm_grupo',
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
					'min' => 1,
					'max' => 50
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'desc_atua_gpr',
			'filters'  => [
				['name' => 'StringTrim'],                    
				['name' => 'StringToUpper'],                    
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
					'min' => 1,
					'max' => 255
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
					'min' => 12,
					'max' => 12
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
			'name'     => 'desc_empresa_gpr',
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
					'min' => 1,
					'max' => 255
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'desc_valor_gpr',
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
					'min' => 1,
					'max' => 255
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'desc_missao_gpr',
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
					'min' => 1,
					'max' => 255
					],
				],
			],
		]);
		
		$inputFilter->add([
			'name'     => 'desc_visao_gpr',
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
					'min' => 1,
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
			],
			'validators' => [
				[
					'breakChainOnFailure' => true,
					'name' => 'StringLength',
					'options' => [
					'min' => 20,
					'max' => 150
					],
					'name' => 'Hostname',
				],
			],
		]);
		
	}

}