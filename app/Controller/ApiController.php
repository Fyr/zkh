<?php
App::uses('AppController', 'Controller');
App::uses('PAjaxController', 'Core.Controller');
class ApiController extends PAjaxController {
    public $components = false;

    public function isAuthorized($user) {
        return true;
    }

    public function client() {
        App::uses('User', 'Model');
        $this->User = $this->loadModel('User');

        if ($this->request->is(array('put', 'post'))) {
            App::uses('Auth', 'Controller/Component');
            $this->Components->load('Auth');
            $this->request->data('password_confirm', $this->request->data('password'));
            if ($this->User->save($this->request->data)) {
                $id = $this->User->id;
                return $this->setResponse($this->User->findById($id));
            } else {
                $this->setError('Error saving data');
                // hot fix to add extra data for error
                $this->_response['validationErrors'] = $this->User->validationErrors;
                return;
            }
        }
        $this->setError('Incorrect request');
    }
}
