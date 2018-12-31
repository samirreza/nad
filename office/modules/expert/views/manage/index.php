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
                        'attribute' => 'userId',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a(
                                $model->email,
                                [
                                    '/user/manage/index',
                                    'UserSearch[email]' => $model->email
                                ],
                                [
                                    'target' => '_blank',
                                    'data-pjax' => '0'
                                ]
                            );
                        },
                        'filter' => Select2::widget([
                            'model' => $searchModel,
                            'attribute' => 'userId',
                            'data' => ArrayHelper::map(
                                User::find()->all(),
                                'id',
                                'email'
                            ),
                            'options' => [
                                'placeholder' => 'ایمیل کاربر را انتخاب کنید'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ]),
                        'headerOptions' => ['style' => 'width:500px']
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
                        'headerOptions' => ['style' => 'width:300px']
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
                    'createdAt:date'
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
