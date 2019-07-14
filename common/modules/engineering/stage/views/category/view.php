<?php
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\widgets\DetailView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

?>
<div class="page-view">
    <div class="row">
        <div class="col-md-6">
            <?php Panel::begin([
                'title' => 'اطلاعات گروه',
                'showCloseButton' => true
            ]) ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'uniqueCode',
                    'code',
                    'title',
                    [
                        'label' => "رده پدر",
                        'visible' => !$model->isRoot(),
                        'value' => $model->isRoot() ?: $model->getParent()->title,
                        'format' => 'raw'
                    ],
                ],
            ]) ?>
            <?php Panel::end() ?>
        </div>
    </div>
</div>
