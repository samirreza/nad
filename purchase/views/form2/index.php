<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use theme\widgets\Panel;
use theme\widgets\ActionButtons;

/* @var $this yii\web\View */
/* @var $searchModel nad\purchase\models\Form2Search */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'بررسی فنی';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form2-index">

    <h2 class="nad-page-title"><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ActionButtons::widget([
        'buttons' => [
            'create' => [
                'label' => 'افزودن بررسی فنی',
            ]
        ]
    ]);?>

<div class="form2-index">
    <?php Panel::begin(['title' => $this->title]) ?>
        <?php Pjax::begin(['id' => 'form2-index-gridviewpjax']) ?>
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
                    'proposal:html',
                    'createdAt:date',
                    'updatedAt:datetime',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end() ?>
    <?php Panel::end() ?>
</div>