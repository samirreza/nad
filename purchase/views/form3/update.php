<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nad\purchase\models\Form3 */

$this->title = 'ویرایش بررسی بازرگانی ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'بررسیهای بازرگانی', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'ویرایش';
?>
<div class="form3-update">

<h2 class="nad-page-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
