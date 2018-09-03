<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = 'انواع تجهیزات';
$this->params['breadcrumbs'][] = 'تجهیزات';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipment-type-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => ['label' => 'نوع تجهیز جدید'],
            'categoriesIndex' => [
                'label' => 'رده های تجهیزات',
                'icon' => 'sitemap'
            ]
        ],
    ]); ?>
    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'equipment-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    ['class' => 'modules\nad\common\grid\CodeColumn'],
                    ['class' => 'core\grid\TitleColumn'],
                    [
                        'attribute' => 'category.title',
                        'value' => function ($model) {
                            return $model->category->familyTreeTitle;
                        }
                    ],
                    [
                        'attribute' => 'createdAt',
                        'format' =>'date',
                        'filter' =>false
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
