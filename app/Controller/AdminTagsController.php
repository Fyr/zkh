<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('AdminContentController', 'Controller');
class AdminTagsController extends AdminContentController {
    public $name = 'AdminTags';
    public $uses = array('Tag');

    public $paginate = array(
        'conditions' => array(),
        'fields' => array('title'),
        'order' => array('title' => 'asc'),
        'limit' => 20
    );
}
