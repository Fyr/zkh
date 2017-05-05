<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('AdminContentController', 'Controller');
App::uses('Article', 'Model');
App::uses('Tag', 'Model');
class AdminArticlesController extends AdminContentController {
    public $name = 'AdminArticles';
    public $uses = array('Article', 'Tag', 'ArticleTag', 'Offer', 'ArticleOffer');

    public $paginate = array(
        'conditions' => array(),
        'fields' => array('created', 'title', 'publish_date'),
        'order' => array('publish_date' => 'desc'),
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
            $tags = $this->ArticleTag->findAllByArticleId($id);
            $tags = ($tags) ? Hash::extract($tags, '{n}.ArticleTag.tag_id') : array();
            $offers = $this->ArticleOffer->findAllByArticleId($id);
            $offers = ($offers) ? Hash::extract($offers, '{n}.ArticleOffer.offer_id') : array();
        }
        $this->set('tags', $tags);
        $this->set('offers', $offers);
    }


    public function afterSave($article_id) {
        $this->ArticleTag->deleteAll(array('article_id' => $article_id));
        foreach($this->request->data('Tag') as $tag_id) {
            $this->ArticleTag->clear();
            $this->ArticleTag->save(compact('article_id', 'tag_id'));
        }

        $this->ArticleOffer->deleteAll(array('article_id' => $article_id));
        foreach($this->request->data('Offer') as $offer_id) {
            $this->ArticleOffer->clear();
            $this->ArticleOffer->save(compact('article_id', 'offer_id'));
        }
    }
}
