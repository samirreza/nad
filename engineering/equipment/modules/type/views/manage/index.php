<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

$this->title = 'انواع تجهیزات';
$this->params['breadcrumbs'] = [
    'فنی',
    $this->title
];

?>

<div class="equipment-type-index">
    <div class="fixed-action-buttons">
        <?= ActionButtons::widget([
            'buttons' => [
                'create' => ['label' => 'نوع تجهیز جدید'],
                'categoriesIndex' => [
                    'label' => 'رده های تجهیزات',
                    'icon' => 'sitemap'
                ]
            ]
        ]) ?>
    </div>
    <?php Panel::begin(['title' => Html::encode($this->title)]) ?>
        <?php Pjax::begin([
            'id' => 'equipment-gridviewpjax',
            'enablePushState' => false
        ]) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'nad\common\code\CodeGridColumn'],
                    ['class' => 'core\grid\TitleColumn'],
                    [
                        'attribute' => 'category.title',
                        'value' => function ($model) {
                            return $model->category->familyTreeTitle;
                        }
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {document}',
                        'buttons' => [
                            'document' => function ($url, $model, $key) {
                                return Html::a(
                                    '<span class="fa fa-book"></span>',
                                    [
                                        'document/index',
                                        'DocumentSearch[equipmentTypeId]' => $model->id
                                    ],
                                    ['title' => 'بایگانی مدارک', 'data-pjax' => 0]
                                );
                            }
                        ]
                    ]
                ]
            ]) ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>
