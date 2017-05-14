<?
    $id = $this->request->data($objectType.'.id');
    $title = $this->ObjectType->getTitle('index', $objectType);
    $breadcrumbs = array(
        __('Users') => 'javascript:;',
        $this->ObjectType->getTitle('index', 'User') => array('controller' => 'AdminUsers', 'action' => 'index'),
        __('Edit') => ''
    );
    // echo $this->element('AdminUI/breadcrumbs', compact('breadcrumbs'));
    // echo $this->element('AdminUI/title', compact('title'));
    echo $this->Flash->render();
?>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">

<?
    echo $this->element('AdminUI/form_title', array('title' => $this->ObjectType->getTitle($id ? 'edit' : 'create', $objectType)));
    echo $this->PHForm->create($objectType);

    $html = $this->PHForm->input('username');

    if ($id == 1) {
        $html.= $this->PHForm->input('password', array('value' => '' , 'required' => !$id));
        $html.= $this->PHForm->input('password_confirm', array('type' => 'password', 'value' => '', 'required' => !$id,
            'label' => array('class' => 'col-md-3 control-label', 'text' => __('Confirm password'))
        ));
    } else {
        /*
        echo $this->PHForm->input('key', array(
            'label' => array('class' => 'col-md-3 control-label', 'text' => __('Licence key'))
        ));
        echo $this->PHForm->input('phone');
        */
        $html.= $this->PHForm->input('email');
        $html.= $this->PHForm->input('password', array('value' => '' , 'required' => !$id));
        $html.= $this->PHForm->input('password_confirm', array('type' => 'password', 'value' => '', 'required' => !$id,
            'label' => array('class' => 'col-md-3 control-label', 'text' => __('Confirm password'))
        ));
    }

    $tabs = array(
        __('General') => $this->Html->div('form-body', $html),
        __('Tags') => $this->element('edit_tags', array('type' => 'Tag', 'aOptions' => $aTagOptions, 'checked' => $tags)),
        __('Offers') => $this->element('edit_tags', array('type' => 'Offer', 'aOptions' => $aOfferOptions, 'checked' => $offers)),
    );
    echo $this->element('AdminUI/tabs', compact('tabs'));
    echo $this->element('AdminUI/form_actions');
    echo $this->PHForm->end();
?>
        </div>
    </div>
</div>
