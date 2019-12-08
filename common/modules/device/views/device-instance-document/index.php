<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use nad\common\helpers\Lookup;
use core\widgets\select2\Select2;
use nad\common\modules\device\models\DeviceInstance;
use theme\widgets\ActionButtons;

$module = $this->context->module;

?>

<h4 class="nad-page-title">لیست گزارشات <span class="nad-page-title-focus"><?= $instanceModel->device->title ?></span></h4>
<div class="document-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن مدرک',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'document-gridviewpjax',
                    'data-params' =>
                        'DeviceInstanceDocument[instanceId]=' . Yii::$app->request->queryParams['DeviceInstanceDocumentSearch']['instanceId']

                ]
            ],
            'deviceIndex' => [
                'label' => 'لیست تجهیزات',
                'icon' => 'list',
                'url' => ['manage/index'],
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
            'id' => 'document-gridviewpjax',
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
                    'uniqueCode',
                    'title',
                    [
                        'header' => 'مدارک',
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