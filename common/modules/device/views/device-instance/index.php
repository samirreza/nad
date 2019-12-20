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

<h4 class="nad-page-title">لیست <span class="nad-page-title-focus"><?= $deviceModel->title ?></span></h4>
<div class="resource-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'device-instance-gridviewpjax',
                    'data-params' =>
                        'DeviceInstance[deviceId]=' . Yii::$app->request->queryParams['DeviceInstanceSearch']['deviceId']

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
            'id' => 'device-instance-gridviewpjax',
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
                            'style' => 'direction: ltr; width:40px'
                        ]
                    ],
                    [
                        'label' => 'گزارش تجهیز',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(
                                    '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                    [
                                        'device-instance-document/index',
                                    'DeviceInstanceDocumentSearch[instanceId]' => $model->id
                                    ],
                                    [
                                        'title' => 'گزارش تجهیز',
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
