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

<h4 class="nad-page-title">لیست قطعات</h4>
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
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'uniqueCode',
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
                        'attribute' => 'deviceUniqueCode',
                    ],
                    [
                        'label' => 'لیست مدارک',
                        'format' => 'html',
                        'value' => function ($model) {
                            return Html::a(
                                    '<i class="fa fa-external-link-square fa-2x" style="color:#398439"></i>',
                                    [
                                        'part-instance-document/index',
                                    'PartInstanceDocumentSearch[instanceId]' => $model->id
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
