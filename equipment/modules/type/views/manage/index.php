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
            'categoriesIndex' => ['label' => 'دسته ها'],
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
                    'compositeCode',
                    [
                        'attribute' => 'category.title',
                        'label' => 'عنوان دسته'
                    ],
                    ['class' => 'core\grid\TitleColumn'],
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
