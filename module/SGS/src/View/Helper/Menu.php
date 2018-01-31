<?php
namespace SGS\View\Helper;

use Zend\View\Helper\AbstractHelper;

class Menu extends AbstractHelper {
	
	protected $items = [];
	
	protected $activeItemId = '';
	
	public function __construct($items=[]) {	
		$this->items = $items;
	}
	
	public function setItems($items){
		$this->items = $items;
	}

	// Sets ID of the active items.
	public function setActiveItemId($activeItemId){
		$this->activeItemId = $activeItemId;    
	}
	
	public function render(){
	
		if (count($this->items)==0)
			return '';

		$result = '<aside id="main-sidebar" class="main-sidebar">';
		$result .= '<section class="sidebar">';
		$result .= '<ul class="active sidebar-menu" data-widget="tree">';

		// Render items
		foreach ($this->items as $item) {
			$result .= $this->renderItem($item);
		}

		$result .= '</ul>';
		$result .= '</section>';
		$result .= '</aside>';

		return $result;
	
	}
	
	protected function renderItem($item){
	
		$id = isset($item['id']) ? $item['id'] : '';
		$isActive = ($id==$this->activeItemId);
		$label = isset($item['label']) ? $item['label'] : '';

		$result = ''; 

		if(isset($item['dropdown'])) {

			/*$dropdownItems = $item['dropdown'];

			$result .= '<li class="dropdown ' . ($isActive?'active':'') . '">';
			$result .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
			$result .= $label . ' <b class="caret"></b>';
			$result .= '</a>';

			$result .= '<ul class="dropdown-menu">';

			foreach ($dropdownItems as $item) {
				$link = isset($item['link']) ? $item['link'] : '#';
				$label = isset($item['label']) ? $item['label'] : '';

				$result .= '<li>';
				$result .= '<a href="'.$link.'">'.$label.'</a>';
				$result .= '</li>';
				
			}

			$result .= '</ul>';
			$result .= '</a>';
			$result .= '</li>';*/

		}else{        
			$link = isset($item['link']) ? $item['link'] : '#';

			$result .= $isActive?'<li class="active">':'<li>';
			$result .= '<a href="'.$link.'"><i class="fa fa-circle-o"></i><span>'.$label.'</span></a>';
			$result .= '</li>';
		}

		return $result;
		
	}
	
}