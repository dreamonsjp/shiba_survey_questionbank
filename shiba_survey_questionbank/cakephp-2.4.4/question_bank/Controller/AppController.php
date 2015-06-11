<?php
class AppController extends Controller {
	var $helpers = array('Form', 'Html', 'Session',	'Js', 'Usermgmt.UserAuth', 'Usermgmt.Image');
	public $components = array('Session', 'RequestHandler', 'Usermgmt.UserAuth', 'DebugKit.Toolbar');

	/* Override functions */
	public function paginate($object = null, $scope = array(), $whitelist = array()) {
		$sessionKey = sprintf('UserAuth.Search.%s.%s', $this->name, $this->action);
		if ($this->Session->check($sessionKey)) {
			$persistedData = $this->Session->read($sessionKey);
			if(!empty($persistedData['page_limit'])) {
				$this->paginate['limit']=$persistedData['page_limit'];
			}
		}
		return parent::paginate($object, $scope, $whitelist);
	}
	function beforeFilter() {
		$this->userAuth();
	}
	private	function userAuth() {
		$this->UserAuth->beforeFilter($this);
	}
}
?>