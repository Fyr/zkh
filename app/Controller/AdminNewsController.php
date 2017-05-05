<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('AdminContentController', 'Controller');
App::uses('News', 'Model');
class AdminNewsController extends AdminContentController {
    public $name = 'AdminNews';
    public $uses = array('News');

    public $paginate = array(
        'conditions' => array(),
        'fields' => array('created', 'title', 'publish_date'),
        'order' => array('publish_date' => 'desc'),
        'limit' => 20
    );
}
