<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('CakeEmail', 'Network/Email');
class Category extends UserMgmtAppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
			'Lang' => array(
					'className' => 'Lang',
					'foreignKey' => 'lang_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);

	function addValidate() {
		$validate1 = array(
				'parent_category_id'=> array(
						'mustNotEmpty'=>array(
								'rule' => 'notEmpty',
								'message'=> __('Please select parent category'),
								'last'=>true),
				),
				'name'=> array(
						'mustNotEmpty'=>array(
								'rule' => 'notEmpty',
								'message'=> __('Please enter category name'),
								'last'=>true),
				),
				'lang_id'=> array(
						'mustNotEmpty'=>array(
								'rule' => 'notEmpty',
								'message'=> __('Please select language'),
								'last'=>true),
				),
		);
		$this->validate=$validate1;
		return $this->validates();
	}

	public function isValidCategoryId($id) {
		if($this->hasAny(array('Category.id'=>$id))) {
			return true;
		}
		return false;
	}
}
