<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use nad\engineering\equipment\modules\type\models\Type;

$equipmentType = Type::findOne($searchModel->equipmentTypeId);

$this->title = 'بایگانی مدارک ' . $equipmentType->title;
$this->params['breadcrumbs'] = [
    'فنی',
    [
        'label' => 'انواع تجهیزات',
        'url' => ['/engineering/equipment/type/manage/index']
    ],
    [
        'label' => $equipmentType->title,
        'url' => ['/engineering/equipment/type/manage/view', 'id' => $equipmentType->id]
    ],
    $this->title
];

?>

<div class="equipment-document-index">
    <div class="fixed-action-buttons">
        <?= ActionButtons::widget([
            'buttons' => [
                'create' => [
                    'label' => 'مدرک جدید',
                    'options' => [
                        'class' => 'ajaxcreate',
                        'data-gridpjaxid' => 'equipment-document-gridviewpjax',
                        'data-equipment-type-id' => $equipmentType->id
                    ]
                ],
                'typeInfo' => [
                    'label' => 'اطلاعات ' . $equipmentType->title,
                    'url' => ['/engineering/equipment/type/manage/view', 'id' => $equipmentType->id],
                    'type' => 'success'
                ],
                'type-index' => [
                    'label' => 'انواع تجهیزات',
                    'url' => ['/engineering/equipment/type/manage/index'],
                    'type' => 'success'
                ]
            ]
        ]) ?>
    </div>
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
                [
                    'class' => 'yii\grid\SerialColumn'
                ],
                'title',
                'uniqueCode',
                [
                    'label' => 'فایل مدرک',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if (!$model->getFile('file')) {
                            return;
                        }
                        return Html::a(
                            'دانلود',
                            $model->getFile('file')->getUrl(),
                            ['data-pjax' => 0]
                        );
                    }
                ],
                'archivesAddress',
                [
                    'attribute' => 'createdAt',
                    'value' => function ($model) {
                        return Yii::$app->formatter->asDate($model->createdAt, 'Y-M-d');
                    }
                ],
                [
                    'class' => 'core\grid\AjaxActionColumn'
                ]
            ]
        ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
