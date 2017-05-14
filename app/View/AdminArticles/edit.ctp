<?
    $id = $this->request->data($objectType.'.id');
/*
    $title = $this->ObjectType->getTitle('index', $objectType);
    $breadcrumbs = array(
        __('Static content') => 'javascript:;',
        $title => array('action' => 'index'),
        __('Edit') => ''
    );
    echo $this->element('AdminUI/breadcrumbs', compact('breadcrumbs'));
    echo $this->element('AdminUI/title', compact('title'));
*/
    echo $this->Flash->render();
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">

<?
    echo $this->element('AdminUI/form_title', array('title' => $this->ObjectType->getTitle($id ? 'edit' : 'create', $objectType)));
    echo $this->PHForm->create($objectType);

    $tabs = array(
        __('General') => $this->Html->div('form-body',
            $this->PHForm->input('title')
            .$this->PHForm->date('publish_date', array(
                'class' => 'form-control input-small',
                'label' => array('text' => 'Дата публикации', 'class' => 'col-md-3 control-label'))
            )
            .$this->PHForm->input('teaser', array('label' => array('class' => 'col-md-3 control-label', 'text' => __('Teaser'))))
        ),
        __('Text') => $this->element('Article.edit_body', array('field' => 'body')),
        __('Tags') => $this->element('edit_tags', array('type' => 'Tag', 'aOptions' => $aTagOptions, 'checked' => $tags)),
        __('Offers') => $this->element('edit_tags', array('type' => 'Offer', 'aOptions' => $aOfferOptions, 'checked' => $offers)),
    );

    if ($id) {
        // $tabs[__('Media')] = $this->element('Media.edit', array('object_type' => $objectType, 'object_id' => $id));
    }

    echo $this->element('AdminUI/tabs', compact('tabs'));
    echo $this->element('AdminUI/form_actions');
    echo $this->PHForm->end();
?>
        </div>
    </div>
</div>
