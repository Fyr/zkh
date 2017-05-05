<?
/*
    $title = $this->ObjectType->getTitle('index', $objectType);
    $breadcrumbs = array(
        __('Static content') => 'javascript:;',
        $title => ''
    );
    echo $this->element('AdminUI/breadcrumbs', compact('breadcrumbs'));
    echo $this->element('AdminUI/title', compact('title'));
*/
    echo $this->Flash->render();

    $columns = $this->PHTableGrid->getDefaultColumns($objectType);
    $columns[$objectType.'.company_id']['label'] = 'Компания';
    $columns[$objectType.'.start_date']['label'] = __('Start date');
    $columns[$objectType.'.end_date']['label'] = __('End date');
    $columns[$objectType.'.discount']['label'] = __('Discount, %');
    // $row_actions = '../AdminNews/row_actions';
    $rowset = $this->PHTableGrid->getDefaultRowset($objectType);
    foreach($rowset as &$row) {
        $row[$objectType]['discount'].= '%';
        $row[$objectType]['company_id'] = Hash::get($aCompanyOptions, $row[$objectType]['company_id']);
    }
?>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light bordered">
            <?=$this->element('AdminUI/form_title', array('title' => 'Офферы'))?>
            <div class="portlet-body dataTables_wrapper">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="btn-group">
                                <a class="btn green" href="<?=$this->Html->url(array('action' => 'edit', 0))?>">
                                    <i class="fa fa-plus"></i> Создать оффер
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                </div>
                <?=$this->PHTableGrid->render($objectType, compact('columns', 'rowset'))?>
            </div>
        </div>
    </div>
</div>
