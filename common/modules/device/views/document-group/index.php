<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use nad\common\helpers\Lookup;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use core\widgets\select2\Select2;
use theme\widgets\ActionButtons;

$module = $this->context->module;
// $this->title = $module->department.' - '.$module->pluralLabel;
// $this->params['breadcrumbs'] = [
//     $module->department,
//     $module->pluralLabel
// ];
?>

<h4 class="nad-page-title">بسته مدارک تجهیز <span class="nad-page-title-focus"><?= $deviceModel->title . ' (' . $deviceModel->code . ')' ?></span></h4>
<div class="resource-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن گروه های مدارک',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'resource-gridviewpjax',
                    'data-params' =>
                        'DocumentGroup[deviceId]=' . $deviceModel->id

                ]
            ],
            // 'categoriesIndex' => [
            //     'label' => 'رده های بسته ' . $module->pluralLabel,
            //     'icon' => 'sitemap'
            // ],
            // 'tree' => [
            //     'label' => 'نمایش درختی رده های بسته مدارک',
            //     'icon' => 'tree',
            //     'url' => ['tree-list']
            // ],
            'deviceIndex' => [
                'label' => 'لیست تجهیزات',
                'icon' => 'sitemap',
                'url' => $this->params['deviceIndex'],
                'type' => 'success'
            ]
        ],
    ]); ?>

    <br>
    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'resource-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'header' => 'شمارنده',
                        'class' => 'yii\grid\SerialColumn'
                    ],
                    [
                        'attribute' => 'title',
                        'value' => function($model){
                            return Lookup::extra('nad.device.documentGroup.type', $model->title, true);
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'title',
                            'data' => Lookup::extras('nad.device.documentGroup.type', true),
                            'options' => [
                                'placeholder' => 'جست‌وجو'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ])
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'uniqueCode',
                        'value' => function($model){
                            return $model->getUniqueCode();
                        }
                    ],
                    // 'createdAt:datetime',
                    [
                        'label' => 'مدارک گروه',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(
                                    '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                    [
                                        '/engineering/piping/device/device/document-group-document/index',
                                    'DocumentGroupDocumentSearch[groupId]' => $model->id
                                    ],
                                    [
                                        'title' => 'لیست مدارک گروه مدارک',
                                        'data-pjax' => 0
                                    ]
                                );
                        }
                    ],
                    [
                        'header' => 'دسترسی',
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
