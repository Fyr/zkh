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

        App::uses('ArticleOffer', 'Model');
        $this->ArticleOffer = $this->loadModel('ArticleOffer');

        $page = $this->request->query('page');
        $limit = $this->request->query('limit');
        $params = array(
            'conditions' => array('Article.object_type' => array('Article', 'News'), 'publish_date >= ' => date('Y-m-d H:i:s')),
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

        if (!($objectType && $id && in_array($objectType, array('News', 'Article', 'Offer')))) {
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
}
