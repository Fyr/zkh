<?php
App::uses('AppController', 'Controller');
App::uses('AdminController', 'Controller');
App::uses('AdminContentController', 'Controller');
App::uses('Article', 'Article.Model');
App::uses('Tag', 'Model');
class AdminArticlesController extends AdminContentController {
    public $name = 'AdminArticles';
    public $uses = array('Article.Article', 'Tag', 'ArticleTag', 'Offer', 'ArticleOffer');

    public $paginate = array(
        'conditions' => array('object_type' => 'Article'),
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
        if ($tags = $this->request->data('Tag')) {
            foreach ($tags as $tag_id) {
                $this->ArticleTag->clear();
                $this->ArticleTag->save(compact('article_id', 'tag_id'));
            }
        }

        $this->ArticleOffer->deleteAll(array('article_id' => $article_id));
        if ($offers = $this->request->data('Offer')) {
            foreach ($offers as $offer_id) {
                $this->ArticleOffer->clear();
                $this->ArticleOffer->save(compact('article_id', 'offer_id'));
            }
        }
    }
}
