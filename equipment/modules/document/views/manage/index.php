<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;
use modules\nad\equipment\modules\document\models\DocumentType;

$this->title = 'لیست اسناد تجهیزات';
$this->params['breadcrumbs'][] = [
    'label' => 'انواع تجهیزات',
    'url' => ['/equipment/type/manage/index']
];
$this->params['breadcrumbs'][] = [
    'label' => $type->title,
    'url' => ['/equipment/type/manage/view', 'id' => $type->id]
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-manage-list">

    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن سند',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'document-gridviewpjax',
                    'data-typeId' => $typeId
                ]
            ],
            'typeInfo' => [
                'label' => 'اطلاعات تجهیز',
                'url' => ['/equipment/type/manage/view', 'id' => $typeId],
                'icon' => 'info',
                'type' => 'primary',
            ],
        ]
    ]) ?>

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
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'documentId',
                'filter' => ArrayHelper::map(
                    DocumentType::find()
                        ->all(),
                    'id',
                    'title'
                ),
                'value' => function ($model) {
                    return $model->docType->title;
                },
            ],
            [
                'attribute' => 'document',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('دریافت', $model->getFile('file')->getUrl(),
                        ['data-pjax' => 0, 'target' => '_blank']);
                },
            ],
            [
                'class' => 'core\grid\AjaxActionColumn',
                'template' => '{update} {delete}',
            ],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>