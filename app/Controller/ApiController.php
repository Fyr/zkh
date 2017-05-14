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

    public function tags() {
        App::uses('Tag', 'Model');
        $this->Tag = $this->loadModel('Tag');
        $this->setResponse($this->Tag->find('list'));
    }

    public function articles() {
        App::uses('Article', 'Article.Model');
        $this->Article = $this->loadModel('Article.Article');

        $page = $this->request->query('page');
        $limit = $this->request->query('limit');
        $params = array(
            'conditions' => array('Article.object_type' => array('Article', 'News', 'Post'), 'publish_date >= ' => date('Y-m-d H:i:s')),
            'fields' => array('id', 'object_type', 'title', 'publish_date', 'teaser'),
            'page' => ($page) ? $page : 1,
            'limit' => ($limit) ? $limit : 10,
            'order' => array('publish_date' => 'desc')
        );

        $articles = $this->Article->find('all', $params);
        $this->setResponse($articles);
    }

    public function view() {
        $objectType = $this->request->query('objectType');
        $id = $this->request->query('id');

        if (!($objectType && $id && in_array($objectType, array('News', 'Article', 'Offer', 'Post')))) {
            return $this->setError('Incorrect request');
        }

        App::uses('Article', 'Model');
        App::uses('Offer', 'Model');
        App::uses('News', 'Model');

        $this->model = $this->loadModel($objectType);
        $object = $this->model->findById($id);
        if ($objectType == 'Article') {
            App::uses('ArticleOffer', 'Model');
            $this->ArticleOffer = $this->loadModel('ArticleOffer');
            $this->Offer = $this->loadModel('Offer');

            $articleOffers = $this->ArticleOffer->findAllByArticleId($id);
            $offers = $this->Offer->findAllById(Hash::extract($articleOffers, '{n}.ArticleOffer.offer_id'));
            $object['Offer'] = Hash::extract($offers, '{n}.Offer');
        }
        $this->setResponse($object);
    }

    public function usertags() {
        App::uses('User', 'Model');
        $this->User = $this->loadModel('User');
        App::uses('UserTag', 'Model');
        $this->UserTag = $this->loadModel('UserTag');

        if ($this->request->is(array('put', 'post'))) {
            $tags = $this->request->data('tags');
            $user_id = intval($this->request->data('user_id'));

            if (!($user_id && is_array($tags))) {
                return $this->setError('Incorrect input parameters');
            }

            if (!$this->User->findById($user_id)) {
                return $this->setError('Incorrect user_id');
            }

            $this->UserTag->deleteAll(array('user_id' => $user_id));
            foreach ($tags as $tag_id) {
                $this->UserTag->clear();
                $this->UserTag->save(compact('user_id', 'tag_id'));
            }

            $tags = $this->UserTag->findAllByUserId($user_id);
            $tags = ($tags) ? Hash::extract($tags, '{n}.UserTag.tag_id') : array();
            return $this->setResponse($tags);
        }
        $this->setError('Incorrect request');
    }

    public function useroffers() {
        App::uses('User', 'Model');
        $this->User = $this->loadModel('User');
        App::uses('UserOffer', 'Model');
        $this->UserOffer = $this->loadModel('UserOffer');

        if ($this->request->is(array('put', 'post'))) {
            $offers = $this->request->data('offers');
            $user_id = intval($this->request->data('user_id'));

            if (!($user_id && is_array($offers))) {
                return $this->setError('Incorrect input parameters');
            }

            if (!$this->User->findById($user_id)) {
                return $this->setError('Incorrect user_id');
            }

            $this->UserOffer->deleteAll(array('user_id' => $user_id));
            foreach ($offers as $offer_id) {
                $this->UserOffer->clear();
                $this->UserOffer->save(compact('user_id', 'offer_id'));
            }

            $offers = $this->UserOffer->findAllByUserId($user_id);
            $offers = ($offers) ? Hash::extract($offers, '{n}.UserOffer.offer_id') : array();
            return $this->setResponse($offers);
        }
        $this->setError('Incorrect request');
    }
}
