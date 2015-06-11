<?php
App::uses('UserMgmtAppController', 'Usermgmt.Controller');
/**
 * Questions Controller
 *
 * @property Question $Question
 * @property PaginatorComponent $Paginator
 */
class QuestionsController extends UserMgmtAppController {

	public $uses = array('Question');
	public $components = array('Paginator', 'RequestHandler', 'Usermgmt.Search');
	public $helpers = array('Js');
	
	public function beforeFilter() {
		parent::beforeFilter();
		if(isset($this->Security) &&  $this->RequestHandler->isAjax()){
			$this->Security->csrfCheck = false;
			$this->Security->validatePost = false;
		}
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Question->recursive = 0;
		$this->set('questions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Question->exists($id)) {
			throw new NotFoundException(__('Invalid question'));
		}
		$options = array('conditions' => array('Question.' . $this->Question->primaryKey => $id), 'recursive'=>2);
		$this->set('question', $this->Question->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$categories = $this->Question->Category->find('list');
		$langs = $this->Question->Lang->find('list');
		$this->set(compact('categories', 'langs'));
		if ($this->request->isPost()) {
			/*
			$question_data_file_extension = @end(explode('.', $this->request->data['Question']['question_data']['name']));
			if(!isset($this->request->data['Question']['question_data']['name']) || !strstr($question_data_file_extension, 'lsq')) {
				$this->Session->setFlash(__('question_data is not correct. Please, try again.'));
				return;
			}
			*/
			$save_data = $this->request->data;
			$save_data = $this->_make_data($save_data);
			$this->Question->set($save_data);
			$QuestionAddValidate = $this->Question->addValidate();
			if($this->RequestHandler->isAjax()) {
				$this->layout = 'ajax';
				$this->autoRender = false;
				if ($QuestionAddValidate) {
					$response = array('error' => 0, 'message' => 'success');
					return json_encode($response);
				} else {
					$response = array('error' => 1,'message' => 'failure');
					$response['data']['Question']  = $this->Question->validationErrors;
					return json_encode($response);
				}
			} else {
				if ($QuestionAddValidate) {
					$this->Question->save($save_data,false);
					$this->Session->setFlash(__('The question is successfully added'));
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
		$categories = $this->Question->Category->find('list');
		$langs = $this->Question->Lang->find('list');
		$this->set(compact('categories', 'langs'));
		if (!empty($id)) {
			if(!$this->Question->isValidQuestionId($id)) {
				$this->redirect(array('action'=>'index', 'page'=>$page));
			}
			if ($this->request->isPut() || $this->request->isPost()) {
				//$this->log("isPost ".$this->request->isPost(), 'debug');
				/*
				$question_data_file_extension = @end(explode('.', $this->request->data['Question']['question_data']['name']));
				if(!isset($this->request->data['Question']['question_data']['name']) || !strstr($question_data_file_extension, 'lsq')) {
					$this->Session->setFlash(__('question_data is not correct. Please, try again.'));
					return;
				}
				*/
				$save_data = $this->request->data;
				$save_data = $this->_make_data($save_data);
				$this->Question->set($save_data);
				$QuestionAddValidate = $this->Question->addValidate();
				if($this->RequestHandler->isAjax()) {
					$this->layout = 'ajax';
					$this->autoRender = false;
					if ($QuestionAddValidate) {
						$response = array('error' => 0, 'message' => 'success');
						return json_encode($response);
					} else {
						$response = array('error' => 1,'message' => 'failure');
						$response['data']['Question']  = $this->Question->validationErrors;
						return json_encode($response);
					}
				} else {
					if ($QuestionAddValidate) {
						if(is_array($save_data['Question']['question_data']) && array_key_exists('error', $save_data['Question']['question_data']) && !empty($save_data['Question']['question_data']['error'])) {
							//unset($save_data['Question']['question_data']);
							$tmp = $this->Question->read('question_data', $id);
							$save_data['Question']['question_data'] = $tmp['Question']['question_data'];
						}
						//$this->log(print_r($save_data, true), 'debug');
						$this->Question->save($save_data,false);
						$this->Session->setFlash(__('The question is successfully edited'));
						$this->request->data = $save_data;
						$this->redirect(array('action'=>'index', 'page'=>$page));
					}
				}
			} else {
				$this->request->data = $this->Question->read(null, $id);
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
		$this->Question->id = $id;
		if (!$this->Question->exists()) {
			throw new NotFoundException(__('Invalid question'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Question->delete()) {
			$this->Session->setFlash(__('The question has been deleted.'));
		} else {
			$this->Session->setFlash(__('The question could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function json_list(){
		$this->layout = 'ajax';
		$this->autoRender = false;
		
		$fields = array('id', 'category_id', 'title', 'type', 'question', 'relevance', 'answer', 'sid', 'gid', 'qid', 'lang_id');
		$options = array();
		if(!empty($_GET['category'])) $options['category_id'] = (int)$_GET['category'];
		if(!empty($_GET['title'])) $options['title LIKE'] = "%".(string)$_GET['title']."%";
		if(!empty($_GET['type'])) $options['type'] = (string)$_GET['title'];
		
		$tmp_questions = $this->Question->find('all', array('fields'=>$fields, 'conditions'=>$options));
		foreach($tmp_questions as $item){
			$results[] = $item['Question'];
		}
		if(!empty($results)) {
			$result_data = array('status'=>'success', 'questions'=>$results);
			//pr($result_data);
			return json_encode($result_data);
		} else {
			return json_encode(array('status'=>'failer', 'message'=>'not found'));
		}
	}
	
	public function json_get($id=0){
		$this->layout = 'ajax';
		$this->autoRender = false;
		if(empty($id)) return array('status'=>'failer', 'message'=>'not found');
		$fields = array('id', 'category_id', 'title', 'type', 'question', 'relevance', 'answer', 'sid', 'gid', 'qid', 'lang_id', 'question_data');
		$options = array();
		if(!empty($id)) $options['id'] = (int)$id;
		
		$result = $this->Question->find('first', array('fields'=>$fields, 'conditions'=>$options));
		if(!empty($result)) {
			$result_data = array('status'=>'success', 'question'=>$result['Question']);
			//pr($result_data);
			return json_encode($result_data);
		} else {
			return json_encode(array('status'=>'error', 'message'=>'not found'));
		}
	}
	
	private function _make_data($save_data){
		if(empty($save_data['Question']['question_data']['tmp_name'])) return $save_data;
		$qustion_data_path = $save_data['Question']['question_data']['tmp_name'];
		$question_data_string = file_get_contents($qustion_data_path);
		$question_data = $this->Question->_xml_to_array(simplexml_load_string($question_data_string));
		$save_data['Question']['question_data'] = $question_data_string;
		$save_data['Question']['qid'] = (int)$question_data['questions']['rows']['row']['qid'];
		$save_data['Question']['sid'] = (int)$question_data['questions']['rows']['row']['sid'];
		$save_data['Question']['gid'] = (int)$question_data['questions']['rows']['row']['gid'];
		$save_data['Question']['title'] = (string)$question_data['questions']['rows']['row']['title'];
		$save_data['Question']['type'] = (string)$question_data['questions']['rows']['row']['type'];
		$save_data['Question']['question'] = (string)$question_data['questions']['rows']['row']['question'];
		$tmp_language = (string)$question_data['questions']['rows']['row']['language'];
		$language_data = $this->Question->Lang->find('first', array('conditions'=>array('slug'=>$tmp_language)));
		$save_data['Question']['language'] = $language_data['Lang']['id'];
		$save_data['Question']['relevance'] = (string)$question_data['questions']['rows']['row']['relevance'];
		if(!empty($question_data['answers']['rows']['row']['answer'])) { 
			$tmp_answers[] = (string)$question_data['answers']['rows']['row']['answer'];
			for($i=0; $i<=count($question_data['answers']['rows']);$i++){
				$tmp_answers[] = (string)$question_data['answers']['rows']['row'][$i]['answer'];
			}
			$save_data['Question']['answer'] = implode("\n",$tmp_answers);
		}
		return $save_data;
	}
}
