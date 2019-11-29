<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use nad\common\helpers\Lookup;
use core\widgets\select2\Select2;
use nad\common\modules\site\models\Document;
use theme\widgets\ActionButtons;

$module = $this->context->module;

?>

<h4 class="nad-page-title">لیست مدارک</h4>
<div class="document-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن مدرک',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'document-gridviewpjax',
                    'data-params' =>
                        'Document[siteId]=' . Yii::$app->request->queryParams['DocumentSearch']['siteId']

                ]
            ],
            'siteIndex' => [
                'label' => 'لیست مکان ها',
                // 'icon' => 'book',
                'url' => $this->params['siteIndex'],
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
                    [
                        'attribute' => 'type',
                        'value' => function ($model) {
                            return $model->type;
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'type',
                            'data' => Lookup::items(Document::LOOKUP_DOCUMENT_TYPE),
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
                    [
                        'header' => 'فایل',
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
