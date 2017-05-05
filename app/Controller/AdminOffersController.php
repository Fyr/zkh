<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('AdminContentController', 'Controller');
App::uses('Offer', 'Model');
App::uses('Company', 'Model');
class AdminOffersController extends AdminContentController {
    public $name = 'AdminOffers';
    public $uses = array('Offer', 'Company');

    public $paginate = array(
        'conditions' => array(),
        'fields' => array('title', 'start_date', 'end_date', 'discount', 'company_id'),
        'limit' => 20
    );

    public function beforeRender() {
        parent::beforeRender();

        $this->set('aCompanyOptions', $this->Company->find('list'));
    }
}
