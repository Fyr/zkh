<?php
App::uses('AppController', 'Controller');
App::uses('Auth', 'Controller/Component');
App::uses('PCAuth', 'Core.Controller/Component');
class AdminAuthController extends AppController {
	public $name = 'AdminAuth';
	public $components = array('Auth', 'Core.PCAuth', 'Flash');
	public $layout = 'login';

	public function beforeFilter() {
	}

	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->loginRedirect);
			}
			$this->Flash->error('Invalid username or password');
		}
	}

	public function logout() {
		$this->Auth->logout();
		return $this->redirect($this->Auth->logoutRedirect);
	}

}
