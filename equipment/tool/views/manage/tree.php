<?php

use theme\widgets\ActionButtons;
use nad\common\widgets\treeView\TreeView;

$module = $this->context->module;

$this->title = $module->department . ' - ' . $module->pluralLabel . ' - نمایش درختی';
$this->params['breadcrumbs'] = [
    $module->department,
    ['label' => $module->pluralLabel, 'url' => ['index']],
    'نمایش درختی'
];

?>
<div class="tree-list">
    <?= ActionButtons::widget([
        'buttons' => [
            'materials' => [
                'label' => $module->pluralLabel,
                'url' => ['index'],
                'type' => 'info',
                'icon' => 'list'
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <div class="row">
        <div class="col-md-6">
            <?= TreeView::widget([
                'title' => 'درخت ' . $module->pluralLabel
            ]) ?>
        </div>
    </div>
</div>

