<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $searchModel nad\purchase\models\Form1Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'درخواست خرید';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form1-index">

    <h2 class="nad-page-title"><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن درخواست',
            ]
        ]
    ]);?>

<div class="form1-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'form1-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'createdBy',
                    // 'updatedBy',
                    'title',
                    'reason:html',
                    'createdAt:date',
                    'updatedAt:datetime',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>