<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use nad\common\helpers\Lookup;
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

<h4 class="nad-page-title">لیست مدارک گروه <span class="nad-page-title-focus"><?= Lookup::extra('nad.device.documentGroup.type', $groupModel->title, true); ?></span> تجهیز <span class="nad-page-title-focus"><?= $groupModel->device->title ?></span></h4>
<div class="document-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن مدرک',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'resource-gridviewpjax',
                    'data-params' =>
                        'DocumentGroupDocument[groupId]=' . Yii::$app->request->queryParams['DocumentGroupDocumentSearch']['groupId']

                ]
            ],
            'deviceIndex' => [
                'label' => 'لیست تجهیزات',
                'icon' => 'sitemap',
                'url' => $this->params['deviceIndex'],
                'type' => 'success'
            ],
            'groupsIndex' => [
                'label' => 'بسته مدارک',
                'icon' => 'book',
                'url' => $this->params['groupsIndex'],
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
                        'class' => 'nad\common\grid\TitleColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'uniqueCode',
                        'value' => function($model){
                            return $model->getUniqueCode();
                        }
                    ],
                    [
                        'header' => 'مدرک',
                        'format' => 'raw',
                        'value' => function($model){
                            if (!$model->hasFile('file')) {
                                return null;
                            }
                            return Html::a(
                                '<span class="fa fa-download"></span>',
                                 $model->getFile('file')->getUrl(),
                                [
                                    'title' => 'دریافت فایل',
                                    'data-pjax' => 0
                                ]
                            );
                        }
                    ],
                    [
                        'header' => 'دسترسی',
                        'class' => 'core\grid\AjaxActionColumn'
                    ],
                    'createdAt:date'
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
