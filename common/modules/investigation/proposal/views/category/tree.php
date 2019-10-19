<?php

use theme\widgets\ActionButtons;
use nad\common\widgets\treeView\TreeView;

$module = $this->context->module;

?>
<div class="tree-list">
    <div class="sliding-form-wrapper"></div>
    <div class="row">
        <div class="col-md-6">
            <?= TreeView::widget([
                'title' => 'نمودار درختی'
            ]) ?>
        </div>
    </div>
</div>

