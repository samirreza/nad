<?php

use yii\helpers\Html;
use theme\widgets\Panel;
use yii\widgets\DetailView;

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
                        'title',
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
                        'createdAt:dateTime',
                        'updatedAt:dateTime'
                    ]
                ]) ?>
            </div>
        <?php Panel::end() ?>
    </div>
</div>
