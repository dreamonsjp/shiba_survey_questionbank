<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 * @property PaginatorComponent $Paginator
*/
class CategoriesController extends AppController {

	/**
	 * Components
	 *
	 * @var array
	 */
	public $components = array('Paginator');

	/**
	 * index method
	 *
	 * @return void
	*/
	public function index() {
		$this->_set_view_variables();
		$this->Category->recursive = 0;
		$this->set('categories', $this->Paginator->paginate());
	}

	/**
	 * view method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->_set_view_variables();
		$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id), 'recursive' => 2);
		$this->set('category', $this->Category->find('first', $options));
	}

	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		$this->_set_view_variables();
		if ($this->request->isPost()) {
			$save_data = $this->request->data;
$this->log(print_r($_REQUEST, true), 'debug');
			$save_data = $this->_make_data($save_data);
			$this->Category->set($save_data);
			$CategoryAddValidate = $this->Category->addValidate();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($CategoryAddValidate) {
					$response = array('error' => 0, 'message' => 'success');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['Category']  = $this->Category->validationErrors;
					return json_encode($response);
				}
			} else {
				if ($CategoryAddValidate) {
					$this->Category->save($save_data,false);
					$this->Session->setFlash(__('The category is successfully added'));
					return $this->redirect(array('action' => 'index'));
				}
			}
		}		
	}

	/**
	 * edit method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		$page= (isset($this->request->params['named']['page'])) ? $this->request->params['named']['page'] : 1;
		$this->_set_view_variables();
		if (!empty($id)) {
			if(!$this->Category->isValidCategoryId($id)) {
				$this->redirect(array('action'=>'index', 'page'=>$page));
			}
			if ($this->request->isPut() || $this->request->isPost()) {
				$save_data = $this->request->data;
				$save_data = $this->_make_data($save_data);
				$this->Category->set($save_data);
				$CategoryAddValidate = $this->Category->addValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($CategoryAddValidate) {
						$response = array('error' => 0, 'message' => 'success');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['Category']  = $this->Category->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($CategoryAddValidate) {
						$this->Category->save($save_data,false);
						$this->Session->setFlash(__('The category is successfully edited'));
						$this->request->data = $save_data;
						$this->redirect(array('action'=>'index', 'page'=>$page));
					}
				}
			} else {
				$this->request->data = $this->Category->read(null, $id);
			}
		} else {
			$this->redirect(array('action'=>'index', 'page'=>$page));
		}
	}

	/**
	 * delete method
	 *
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function json_list($mode=1){
		$this->layout = 'ajax';
		$this->autoRender = false;
		if($mode==1){
			$fields = array('id','parent_category_id','name','lang_id');
			$options = array('parent_category_id'=>1);
			if(!empty($_GET['parent_category'])) $options['parent_category_id'] = (int)$_GET['parent_category'];
		}
		$tmp_categories = $this->Category->find('all', array('fields'=>$fields, 'conditions'=>$options));
		foreach($tmp_categories as $item){
			$results[] = $item['Category'];
		}
		if(!empty($results)) {
			$result_data = array('status'=>'success', 'categories'=>$results);
			return json_encode($result_data);
		} else {
			return json_encode(array('status'=>'error', 'message'=>'not found'));
		}
	}
	
	private function _set_view_variables(){
		$this->topCategories = $this->Category->find('list', array('conditions'=>array('parent_category_id'=>0)));
		$this->set('topCategories', $this->Category->find('list', array('conditions'=>array('parent_category_id'=>$this->topCategories))));
		
		$langs = $this->Category->Lang->find('list');
		$this->set(compact('langs'));
	}
	
	private function _make_data($save_data){
		return $save_data;
	}
	
}
