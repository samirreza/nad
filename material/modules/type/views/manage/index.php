<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use themes\admin360\widgets\Panel;
use themes\admin360\widgets\ActionButtons;

$this->title = 'انواع مواد';
$this->params['breadcrumbs'][] = 'مواد';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-type-index">
    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'نوع ماده جدید',
                'options' => [
                    'class' => 'ajaxcreate',
                    'data-gridpjaxid' => 'material-gridviewpjax'
                ]
            ],
            'categoriesIndex' => ['label' => 'گروه ها'],
        ],
    ]); ?>

    <div class="sliding-form-wrapper"></div>

    <?php Panel::begin([
        'title' => Html::encode($this->title)
    ]) ?>
        <?php Pjax::begin([
            'id' => 'material-gridviewpjax',
            'enablePushState' => false,
        ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'compositeCode',
                    [
                        'class' => 'core\grid\TitleColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'attribute' => 'category.title',
                        'label' => 'عنوان گروه',
                        'value' => function ($model) {
                            return $model->category->familyTreeTitle;
                        }
                    ],
                    'titleEn',
                    [
                        'attribute' => 'createdAt',
                        'format' =>'date',
                        'filter' =>false
                    ],
                    ['class' => 'core\grid\AjaxActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
