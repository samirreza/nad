<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

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
            'categoriesIndex' => [
                'label' => 'رده های مواد',
                'icon' => 'sitemap'
            ],
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
                    [
                        'class' => 'modules\nad\common\grid\CodeColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'class' => 'core\grid\TitleColumn',
                        'isAjaxGrid' => true
                    ],
                    [
                        'attribute' => 'category.title',
                        'value' => function ($model) {
                            return $model->category->familyTreeTitle;
                        }
                    ],
                    'titleEn',
                    ['class' => 'core\grid\AjaxActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    <?php Panel::end() ?>
</div>
