<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = 'انواع تجهیزات';
$this->params['breadcrumbs'] = [
    'آی تی',
    'تجهیزات',
    $this->title
];
?>
<div class="equipment-type-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'نوع تجهیز جدید',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'equipment-gridviewpjax'
                ]
            ],
            'categoriesIndex' => [
                'label' => 'رده های تجهیزات',
                'icon' => 'sitemap'
            ],
            'tree' => [
                'label' => 'نمایش درختی',
                'icon' => 'tree',
                'url' => ['tree-list']
            ]
        ],
    ]); ?>

    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'equipment-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'class' => 'core\grid\TitleColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'attribute' => 'category.title',
                        'value' => function ($model) {
                            return $model->category->familyTreeTitle;
                        }
                    ],
                    [
                        'class' => 'core\grid\AjaxActionColumn',
                        'template' => '{view} {update} {delete} {download}',
                        'buttons' => [
                            'download' => function ($url, $model, $key) {
                                if (!$model->hasFile('file')) {
                                    return;
                                }
                                return Html::a(
                                    '<span class="fa fa-download"></span>',
                                    $model->getFile('file')->getUrl(),
                                    [
                                        'title' => 'دریافت سند',
                                        'data-pjax' => 0
                                    ]
                                );
                            },
                        ],
                    ]
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
