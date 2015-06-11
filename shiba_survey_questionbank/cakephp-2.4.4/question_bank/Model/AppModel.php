<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	function _xml_to_array(SimpleXMLElement $parent) {
		$array = array();
		foreach ($parent as $name => $element) {
			($node = & $array[$name])
			&& (1 === count($node) ? $node = array($node) : 1)
			&& $node = & $node[];
			$node = $element->count() ? $this->_xml_to_array($element) : trim($element);
		}
		return $array;
	}
}
