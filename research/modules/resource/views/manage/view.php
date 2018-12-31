<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use yii\widgets\DetailView;
use nad\research\modules\resource\models\Resource;

?>

<div class="row">
    <div class="col-md-8">
        <?php Panel::begin([
            'title' => 'اطلاعات منبع',
            'showCloseButton' => true
        ]) ?>
            <div class="resource-view">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'uniqueCode',
                        'title',
                        [
                            'attribute' => 'type',
                            'value' => function ($model) {
                                return Resource::getTypeLabels()[$model->type];
                            }
                        ],
                        [
                            'label' => 'فایل',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a(
                                    'دانلود فایل',
                                    $model->getFile('resource')->getUrl(),
                                    [
                                        'data-pjax' => '0'
                                    ]
                                );
                            }
                        ],
                        'description:raw',
                        'createdAt:date'
                    ]
                ]) ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
