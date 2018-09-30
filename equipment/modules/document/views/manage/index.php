<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use yii\helpers\ArrayHelper;
use theme\widgets\ActionButtons;
use core\widgets\select2\Select2;
use modules\nad\equipment\modules\type\models\Type;
use modules\nad\equipment\modules\document\models\DocumentType;

$equipmentType = Type::findOne(Yii::$app->request->get('equipmentTypeId'));

$this->title = 'لیست اسناد';
$this->params['breadcrumbs'][] = [
    'label' => 'انواع تجهیزات',
    'url' => ['/equipment/type/manage/index']
];
$this->params['breadcrumbs'][] = [
    'label' => $equipmentType->title,
    'url' => ['/equipment/type/manage/view', 'id' => $equipmentType->id]
];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="equipment-document-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'بارگذاری سند',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'equipment-document-gridviewpjax',
                    'data-typeId' => $equipmentType->id
                ]
            ],
            'typeInfo' => [
                'label' => 'اطلاعات ' . $equipmentType->title,
                'url' => ['/equipment/type/manage/view', 'id' => $equipmentType->id],
                'icon' => 'info',
                'type' => 'primary',
            ]
        ]
    ]) ?>
    <div class="sliding-form-wrapper"></div>
    <?php Panel::begin(['title' => Html::encode($this->title)]) ?>
        <?php Pjax::begin([
            'id' => 'equipment-document-gridviewpjax',
            'enablePushState' => false
        ]) ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'documentTypeId',
                    'headerOptions' => ['style' => 'width:200px'],
                    'filter' => Select2::widget([
                        'model' => $searchModel,
                        'attribute' => 'documentTypeId',
                        'data' => ArrayHelper::map(
                            DocumentType::find()->all(),
                            'id',
                            'title'
                        ),
                        'options' => [
                            'placeholder' => 'نوع سند را انتخاب کنید'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ]
                    ]),
                    'value' => function ($model) {
                        return $model->documentType->title;
                    }
                ],
                [
                    'label' => 'فایل سند',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return Html::a(
                            'دریافت',
                            $model->getFile('file')->getUrl(),
                            ['data-pjax' => 0]
                        );
                    }
                ],
                [
                    'class' => 'core\grid\AjaxActionColumn',
                    'template' => '{update} {delete}'
                ]
            ]
        ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
