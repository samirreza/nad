<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use modules\user\backend\models\User;
use nad\office\modules\expert\models\Expert;

$this->title = 'کارشناسان';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="expert-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'درج کارشناس',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'expert-index-gridviewpjax'
                ]
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'expert-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'attribute' => 'name',
                        'label' => 'نام',
                        'value' => function ($model) {
                            return $model->user->name;
                        },
                        'headerOptions' => ['style' => 'width:15%']
                    ],
                    [
                        'attribute' => 'surname',
                        'label' => 'نام خانوادگی',
                        'value' => function ($model) {
                            return $model->user->surname;
                        },
                        'headerOptions' => ['style' => 'width:15%']
                    ],
                    [
                        'attribute' => 'email',
                        'label' => 'ایمیل',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(
                                $model->user->email,
                                [
                                    '/user/manage/index',
                                    'UserSearch[email]' => $model->user->email
                                ],
                                [
                                    'target' => '_blank',
                                    'data-pjax' => '0'
                                ]
                            );
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'email',
                            'data' => ArrayHelper::map(
                                User::find()->all(),
                                'email',
                                'email'
                            ),
                            'options' => [
                                'placeholder' => 'ایمیل کارشناس را انتخاب کنید'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'headerOptions' => ['style' => 'width:25%']
                    ],
                    [
                        'attribute' => 'departmentId',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Expert::getDepartmentLabels()[$model->departmentId];
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'departmentId',
                            'data' => Expert::getDepartmentLabels(),
                            'options' => [
                                'placeholder' => 'دپارتمان کاربر را انتخاب کنید'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'headerOptions' => ['style' => 'width:20%']
                    ],
                    [
                        'header' => 'مدارک',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if (!$model->getFile('evidence')) {
                                return;
                            }
                            return Html::a(
                                'دانلود مدارک',
                                $model->getFile('evidence')->getUrl(),
                                [
                                    'data-pjax' => '0'
                                ]
                            );
                        }
                    ],
                    'createdAt:date',
                    [
                        'class' => 'core\grid\AjaxActionColumn',
                        'template' => '{update}'
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
