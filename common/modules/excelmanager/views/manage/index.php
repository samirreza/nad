<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$module = $this->context->module;

?>

<h4 class="nad-page-title">لیست فایل های اکسل</h4>
<div class="resource-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن فایل',
            ]
        ],
    ]); ?>

    <br>

    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'excel-file-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'header' => 'شمارنده',
                        'class' => 'yii\grid\SerialColumn',
                        'options' => ['width' => '10px']
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'title',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان'
                        ]
                    ],
                    [
                        'class' => 'nad\common\grid\Column',
                        'attribute' => 'uniqueCode',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو شناسه',
                            'dir' => 'ltr'
                        ],
                        'options' => [
                            'dir' => 'ltr'
                        ]
                    ],
                    // 'createdAt:datetime',
                    // [
                    //     'header' => 'مدارک',
                    //     'format' => 'raw',
                    //     'contentOptions' => [
                    //         'style' => 'direction: ltr; width:100px'
                    //     ],
                    //     'value' => function($model){
                    //         if (!$model->hasFile('file')) {
                    //             return null;
                    //         }
                    //         return Html::a(
                    //             '<span class="fa fa-download"></span>',
                    //              $model->getFile('file')->getUrl(),
                    //             [
                    //                 'title' => 'دریافت فایل',
                    //                 'data-pjax' => 0
                    //             ]
                    //         );
                    //     }
                    // ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'دسترسی',
                        'template' => '{view}',
                        'options' => [
                            'width' => '50px'
                        ],
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    $url,
                                    [
                                        'target' => '_blank',
                                        'data-pjax' => 0,
                                        'title' => 'روند',
                                        'style' => 'color: green'
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
