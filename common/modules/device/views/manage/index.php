<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$module = $this->context->module;
// $this->title = $module->department.' - '.$module->pluralLabel;
// $this->params['breadcrumbs'] = [
//     $module->department,
//     $module->pluralLabel
// ];
?>

<h4 class="nad-page-title">لیست تجهیزات</h4>
<div class="part-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن تجهیز',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'part-gridviewpjax',
                    // 'data-params' =>
                    //     'Location[categoryId]=' . $categoryModel->id

                ]
            ],
            'categoryIndex' => [
                'label' => 'رده های تجهیزات',
                'icon' => 'list',
                'url' => ['category/index'],
                'type' => 'success',
            ],
            'tree' => [
                'label' => 'نمایش درختی',
                'icon' => 'tree',
                'url' => ['tree-list'],
                'type' => 'success',
            ],
            'lookupIndex' => [
                'label' => 'تعریف نام مدارک',
                'icon' => 'list',
                'url' => ['doc-name-lookup/index'],
                'type' => 'success',
            ]
        ],
    ]); ?>

    <br>

    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'part-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'header' => 'شمارنده',
                        'class' => 'yii\grid\SerialColumn',
                        'contentOptions' => [
                            'style' => 'direction: ltr; width:40px'
                        ]
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'attribute' => 'uniqueCode',
                        'contentOptions' => [
                            'style' => 'direction: ltr; width:160px'
                        ]
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'title',
                    ],
                    [
                        'attribute' => 'instances',
                        'label' => 'تعداد تجهیز',
                        'format' => 'raw',
                        'value' => function($model){
                            return Html::a(
                                $model->getInstances()->count(),
                            [
                                'device-instance/index',
                                'DeviceInstanceSearch[deviceId]' => $model->id
                            ],
                            [
                                'style' => 'color: green; font-weight: bold; font-size: 1.5em;'
                            ]
                            );
                        }
                    ],
                    [
                        'attribute' => 'parts',
                        'label' => 'لیست قطعات',
                        'format' => 'raw',
                        'value' => function($model){
                            return Html::a(
                                '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                [
                                    'device-part/index',
                                'DevicePartSearch[deviceId]' => $model->id,
                                ],
                                [
                                    'title' => 'لیست قطعات',
                                    'data-pjax' => 0
                                ]
                            );
                        }
                    ],
                    // [
                    //     'class' => 'nad\common\grid\Column',
                    //     'attribute' => 'code',
                    // ],
                    [
                        'label' => 'لیست مدارک',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(
                                    '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                    [
                                        'device-document/index',
                                    'DeviceDocumentSearch[deviceId]' => $model->id
                                    ],
                                    [
                                        'title' => 'لیست مدارک',
                                        'data-pjax' => 0
                                    ]
                                );
                        }
                    ],
                    [
                        'header' => 'دسترسی',
                        'class' => 'core\grid\AjaxActionColumn',
                        'template' => '{view} {update} {delete}',
                    ],
                    'createdAt:date',
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
