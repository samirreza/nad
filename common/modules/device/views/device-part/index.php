<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use nad\common\helpers\Lookup;
use theme\widgets\ActionButtons;
use nad\common\modules\device\models\DevicePart;

$module = $this->context->module;
$this->title = 'لیست قطعات';
// $this->params['breadcrumbs'] = [
//     $module->department,
//     $module->pluralLabel
// ];
?>

<h4 class="nad-page-title">لیست قطعات <span class="nad-page-title-focus"><?= $deviceModel->title ?></span></h4>
<div class="part-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن قطعه',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'part-gridviewpjax',
                    'data-params' =>
                        'DevicePart[deviceId]=' . Yii::$app->request->queryParams['DevicePartSearch']['deviceId']

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
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'uniqueCode',
                        'contentOptions' => [
                            'style' => 'direction: ltr; width:40px'
                        ]
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'title',
                    ],
                    [
                        'attribute' => 'group',
                        'filter' => Lookup::items(DevicePart::LOOKUP_GROUP_TYPE),
                        'value' => function($model){
                            return Lookup::item(DevicePart::LOOKUP_GROUP_TYPE, $model->group);
                        }
                    ],
                    [
                        'attribute' => 'instances',
                        'label' => 'تعداد',
                        'format' => 'html',
                        'value' => function($model){
                            return Html::a(
                                $model->getInstances()->count(),
                            [
                                'part-instance/index',
                                'PartInstanceSearch[partId]' => $model->id
                            ],
                            [
                                'style' => 'color: green; font-weight: bold; font-size: 1.5em;'
                            ]
                            );
                        }
                    ],
                    [
                        'label' => 'لیست مدارک',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(
                                    '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                    [
                                        'device-part-document/index',
                                    'DevicePartDocumentSearch[partId]' => $model->id
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
