<?php
App::uses('UserMgmtAppModel', 'Usermgmt.Model');
App::uses('CakeEmail', 'Network/Email');
class Question extends UserMgmtAppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'title';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	var $validate = array();

	/**
	 * belongsTo associations
	 *
	 * @var array
	*/
	public $belongsTo = array(
			'Category' => array(
					'className' => 'Category',
					'foreignKey' => 'category_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			),
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
				'category_id'=> array(
						'mustNotEmpty'=>array(
								'rule' => 'notEmpty',
								'message'=> __('Please select category'),
								'last'=>true),
				),
				'title'=> array(
						'mustNotEmpty'=>array(
								'rule' => 'notEmpty',
								'message'=> __('Please upload Question Data'),
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

	public function isValidQuestionId($id) {
		if($this->hasAny(array('Question.id'=>$id))) {
			return true;
		}
		return false;
	}
}
