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
    echo $this->element('AdminUI/form_title', array('title' => ($id) ? 'Редактировать оффер' : 'Создать оффер'));
    echo $this->PHForm->create($objectType);
/*
    if (!$this->request->data('Offer.modified')) {
        $this->request->data('Offer.modified', date('Y-m-d H:i:s'));
    }
*/
    // $this->request->data('Offer.start_date', ' ');
    $tabs = array(
        __('General') => $this->Html->div('form-body',
            $this->PHForm->input('title', array('label' => array('class' => 'col-md-3 control-label', 'text' => __('Title'))))
            .$this->PHForm->input('company_id', array('options' => $aCompanyOptions))
            .$this->PHForm->date('start_date', array(
                'class' => 'form-control input-small',
                'label' => array('text' => __('Start date'), 'class' => 'col-md-3 control-label')
            ))
            .$this->PHForm->date('end_date', array(
                'class' => 'form-control input-small',
                'label' => array('text' => __('End date'), 'class' => 'col-md-3 control-label')
            ))
            .$this->PHForm->input('discount', array(
                'class' => 'form-control input-small',
                'label' => array('text' => __('Discount, %'), 'class' => 'col-md-3 control-label')
            ))
            //.$this->PHForm->input('sorting', array('class' => 'form-control input-small'))
        ),
        __('Text') => $this->element('Article.edit_body', array('field' => 'body')),
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
