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
    echo $this->element('AdminUI/form_title', array('title' => ($id) ? 'Редактировать тэг' : 'Создать тэг'));
    echo $this->PHForm->create($objectType);

    echo $this->PHForm->input('title');
    echo $this->element('AdminUI/form_actions');
    echo $this->PHForm->end();
?>
        </div>
    </div>
</div>
