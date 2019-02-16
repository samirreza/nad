<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use yii\widgets\DetailView;

?>

<div class="equipment-type-document-view">
    <div class="row">
        <div class="col-md-12">
        <?php Panel::begin([
            'title' => 'اطلاعات مدرک',
            'showCloseButton' => true
        ]) ?>
            <div class="col-md-6">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'title',
                        'uniqueCode',
                        'archivesAddress',
                        [
                            'label' => 'فایل مدرک',
                            'format' => 'raw',
                            'value' => Html::a(
                                'دانلود',
                                $model->getFile('file')->getUrl(),
                                ['data-pjax' => 0]
                            )
                        ],
                        'createdAt:date',
                        'updatedAt:date'
                    ]
                ]) ?>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <?= $model->description ?>
                </div>
            </div
        <?php Panel::end() ?>
        </div>
    </div>
</div>
