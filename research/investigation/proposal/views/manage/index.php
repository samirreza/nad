<?php

use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use core\widgets\select2\Select2;
use nad\office\modules\expert\models\Expert;
use nad\research\investigation\proposal\models\Proposal;

$this->title = 'پروپوزال‌ها';
$this->params['breadcrumbs'] = [
    'پژوهش',
    'بررسی',
    $this->title
];

?>

<div class="proposal-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'proposal-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'core\grid\TitleColumn',
                        'headerOptions' => ['style' => 'width:80%'],
                        'filterInputOptions' => [
                            'class'       => 'form-control',
                            'placeholder' => 'جست‌و‌جو عنوان پروپوزال'
                        ]
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'isAjaxGrid' => false,
                        'options' => ['style' => 'width:5%']
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
                                Expert::getDepartmentExperts(
                                    Expert::DEPARTMENT_RESEARCH
                                ),
                                'userId',
                                'fullName'
                            ),
                            'options' => [
                                'placeholder' => 'کارشناس را انتخاب کنید'
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ]
                        ])
                    ],
                    'createdAt:date',
                    [
                        'attribute' => 'status',
                        'filter' => Proposal::getStatusLables(),
                        'value' => function ($model) {
                            return Proposal::getStatusLables()[$model->status];
                        },
                        'options' => ['style' => 'width:10%']
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
