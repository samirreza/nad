<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$module = $this->context->module;
$this->title = 'لیست قطعات';
// $this->params['breadcrumbs'] = [
//     $module->department,
//     $module->pluralLabel
// ];
?>

<h4 class="nad-page-title">لیست قطعات <span class="nad-page-title-focus"><?= $partModel->device->title ?></span></h4>
<div class="resource-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن قطعه',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'part-instance-gridviewpjax',
                    'data-params' => 'PartInstance[partId]=' . Yii::$app->request->queryParams['PartInstanceSearch']['partId']

                ]
            ],
            'tree' => [
                'label' => 'لیست تجهیزات',
                'icon' => 'list',
                'url' => ['manage/index'],
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
            'id' => 'part-instance-gridviewpjax',
            'enablePushState' => true,
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
                            'style' => 'direction: ltr; width:40px'
                        ]
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'label' => 'عنوان',
                        'attribute' => 'partTitle',
                        'value' => function($model){
                            return $model->part->title;
                        }
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'label' => 'شناسه یکتا تجهیز',
                        'attribute' => 'deviceInstanceId',
                        'value' => function($model){
                            $deviceInstance = $model->deviceInstance;
                            return isset($deviceInstance)?$deviceInstance->uniqueCode : null;
                        }
                    ],
                    [
                        'label' => 'لیست مدارک',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(
                                    '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                    [
                                        'device-part-instance-document/index',
                                    'DevicePartInstanceDocumentSearch[instanceId]' => $model->partId
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
