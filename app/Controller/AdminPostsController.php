<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('AdminContentController', 'Controller');
App::uses('Post', 'Model');
class AdminPostsController extends AdminContentController {
    public $name = 'AdminPosts';
    public $uses = array('Post');

    public $paginate = array(
        'conditions' => array(),
        'fields' => array('created', 'title', 'publish_date'),
        'order' => array('publish_date' => 'desc'),
        'limit' => 20
    );
}
