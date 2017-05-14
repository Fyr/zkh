<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('AdminContentController', 'Controller');
App::uses('User', 'Model');
App::uses('Tag', 'Model');
App::uses('Offer', 'Model');
App::uses('UserTag', 'Model');
App::uses('UserOffer', 'Model');
class AdminUsersController extends AdminContentController {
    public $name = 'AdminUsers';
    public $uses = array('User', 'Tag', 'Offer', 'UserTag', 'UserOffer');

    public $paginate = array(
        'conditions' => array('User.id <> ' => 1),
        'fields' => array('created', 'username', 'email'),
        'order' => array('created' => 'desc'),
        'limit' => 20
    );

    public function beforeRender() {
        parent::beforeRender();

        $this->set('aTagOptions', $this->Tag->find('list'));
        $this->set('aOfferOptions', $this->Offer->find('list'));
    }

    public function edit($id = 0, $parent_id = '') {
        parent::edit($id, $parent_id);

        $tags = array();
        $offers = array();
        if ($id) {
            $tags = $this->UserTag->findAllByUserId($id);
            $tags = ($tags) ? Hash::extract($tags, '{n}.UserTag.tag_id') : array();
            $offers = $this->UserOffer->findAllByUserId($id);
            $offers = ($offers) ? Hash::extract($offers, '{n}.UserOffer.offer_id') : array();
        }
        $this->set('tags', $tags);
        $this->set('offers', $offers);
    }

    public function afterSave($user_id) {
        $this->UserTag->deleteAll(array('user_id' => $user_id));
        if ($tags = $this->request->data('Tag')) {
            foreach ($tags as $tag_id) {
                $this->UserTag->clear();
                $this->UserTag->save(compact('user_id', 'tag_id'));
            }
        }

        $this->UserOffer->deleteAll(array('user_id' => $user_id));
        if ($offers = $this->request->data('Offer')) {
            foreach ($offers as $offer_id) {
                $this->UserOffer->clear();
                $this->UserOffer->save(compact('user_id', 'offer_id'));
            }
        }
    }
}
