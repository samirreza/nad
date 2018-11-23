<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use modules\user\backend\models\User;

$this->title = 'لیست کارشناسان';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="expert-index">
    <?= ActionButtons::widget([
        'visibleFor' => ['research.manageExperts'],
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
                    ['class' => 'core\grid\IDColumn'],
                    [
                        'attribute' => 'userId',
                        'headerOptions' => ['style' => 'width:500px'],
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
                        }
                    ],
                    'createdAt:dateTime'
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
