<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use core\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\common\modules\investigation\instruction\models\Instruction;

?>

<h3 class="nad-page-title">دستورالعملهای داده گاه</h3>
<div class="sliding-form-wrapper"></div>
<div class="instruction-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'instruction-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'filterUrl' => ['archived-index'],
                'columns' => [
                    [
                        'attribute' => 'title',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان'
                        ]
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'filterInputOptions' => [
                            'class' => 'form-control',
                            'placeholder' => 'جست‌و‌جو'
                        ],
                        'options' => [
                            'width' => '100px'
                        ]
                    ],
                    [
                        'attribute' => 'createdBy',
                        'value' => function ($model) {
                            return $model->researcher->fullName;
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'createdBy',
                            'data' => ArrayHelper::map(
                                Expert::find()->all(),
                                'userId',
                                'user.fullName'
                            ),
                            'options' => [
                                'placeholder' => 'جست‌وجو'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ])
                    ],
                    // [
                    //     'attribute' => 'createdAt',
                    //     'format' => ['date', 'Y-M-d']
                    // ],
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            // TODO move it to a state in "Instruction::getUserHolderLables()"
                            if($model->expertId != null && $model->status == Instruction::STATUS_ACCEPTED){
                                return 'منتظر ارسال جهت نگارش منشا';
                            }
                            return Instruction::getStatusLables()[$model->status];
                        },
                        'filter' => Instruction::getStatusLables(),
                        'options' => [
                            'width' => '150px'
                        ]
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'دسترسی',
                        'template' => '{view} {certificate}',
                        'options' => [
                            'width' => '50px'
                        ],
                        'buttons' => [
                            'view' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    Url::to(['archived-view', 'id' => $model->id]),
                                    [
                                        'title' => 'مدرک',
                                        'style' => 'color: green'
                                    ]
                                );
                            },
                            'certificate' => function ($url, $model) {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-book"></span>',
                                    Url::to(['archived-certificate', 'id' => $model->id]),
                                    [
                                        'title' => 'شناسنامه',
                                        'style' => 'color: green'
                                    ]
                                );
                            },
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>