<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('AdminContentController', 'Controller');
class AdminCompaniesController extends AdminContentController {
    public $name = 'AdminCompanies';
    public $uses = array('Company');

    public $paginate = array(
        'conditions' => array(),
        'fields' => array('title', 'phone'),
        'order' => array('title' => 'asc'),
        'limit' => 20
    );
}
