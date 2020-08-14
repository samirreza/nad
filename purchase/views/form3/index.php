<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $searchModel nad\purchase\models\Form3Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'بررسی بازرگانی';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form3-index">

    <h2 class="nad-page-title"><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن بررسی بازرگانی',
            ]
        ]
    ]);?>

<div class="form3-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'form3-index-gridviewpjax']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    // 'createdBy',
                    // 'updatedBy',
                    'title',
                    'productName:html',
                    'productIdentifier',
                    'deliveryDate',
                    'price',
                    'prepayment',
                    'createdAt:date',
                    'updatedAt:datetime',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>