<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\research\extensions\resource\models\Resource;

$this->title = 'منابع';
$this->params['breadcrumbs'] = [
    'پژوهش',
    $clientTitle,
    $this->title
];

?>

<div class="resource-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create-resource' => [
                'label' => 'منبع جدید',
                'url' => [
                    'create',
                    'clientId' => $clientId
                ],
                'icon' => 'plus',
                'type' => 'success',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'resource-index-gridviewpjax'
                ]
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'resource-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'uniqueCode',
                        'filterInputOptions' => [
                            'class'       => 'form-control',
                            'placeholder' => 'جست‌و‌جو شناسه منبع'
                        ]
                    ],
                    [
                        'attribute' => 'title',
                        'filterInputOptions' => [
                            'class'       => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان منبع'
                        ]
                    ],
                    [
                        'attribute' => 'type',
                        'value' => function ($model) {
                            return Resource::getTypeLabels()[$model->type];
                        },
                        'filter' => Resource::getTypeLabels()
                    ],
                    [
                        'header' => 'فایل',
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
                    'createdAt:date',
                    [
                        'class' => 'core\grid\AjaxActionColumn',
                        'template' => '{update} {view} {delete}'
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
