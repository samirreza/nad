<?php

use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\engineering\equipment\modules\type\models\Type;
use nad\engineering\equipment\modules\type\details\models\Part;

$type = Type::findOne(Yii::$app->request->get('typeId'));
$this->title = 'مدل های قطعات - ' . $type->uniqueCode ;
$this->params['breadcrumbs'] = [
    'تجهیزات',
    ['label' => 'انواع', 'url' => ['../manage/index']],
    ['label' => $type->uniqueCode, 'url' => ['../manage/view', 'id' => $type->id]],
    ['label' => 'قطعات', 'url' => ['part/index', 'typeId' => $type->id]],
    $this->title
];

?>

<div class="models-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'مدل جدید',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'models-gridviewpjax',
                    'data-typeId' => $type->id,
                    'data-post-params' => "{\"typeId\": {$type->id}}",
                ]
            ],
            'ownerType' => [
                'label' => 'اطلاعات تجهیز',
                'url' => ['../manage/view', 'id' => $type->id],
                'type' => 'info',
                'icon' => 'info'
            ],
            'ownerParts' => [
                'label' => 'قطعات تجهیز',
                'url' => ['part/index', 'typeId' => $type->id],
                'type' => 'warning',
                'icon' => 'cog'
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <?php Panel::begin(['title' => 'لیست مدل ها']) ?>
        <?php Pjax::begin([
            'id' => 'models-gridviewpjax',
            'enablePushState' => false
        ]) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    [
                        'class' => 'yii\grid\SerialColumn'
                    ],
                    [
                        'class' => 'nad\common\code\CodeGridColumn',
                        'options' => ['style' => 'width:30%'],
                        'isAjaxGrid' => true
                    ],
                    'code',
                    [
                        'attribute' => 'partId',
                        'value' => function ($model) {
                            return $model->part->uniqueCode;
                        },
                        'filter' => ArrayHelper::map(
                            Part::find()->where(['typeId' => $type->id])->all(),
                            'id',
                            'uniqueCode'
                        )
                    ],
                    [
                        'class' => 'core\grid\TitleColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'class' => 'core\grid\AjaxActionColumn'
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
