<?php

use theme\widgets\ActionButtons;
use nad\common\widgets\treeView\TreeView;

$module = $this->context->module;

?>
<div class="tree-list">
    <?= ActionButtons::widget([
        'buttons' => [
            'stageCategories' => [
                'label' => 'لیست ' . $module->pluralLabel,
                'url' => ['index'],
                'type' => 'success',
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

