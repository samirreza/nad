<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nad\purchase\models\Form1 */

$this->title = 'افزودن درخواست خرید';
$this->params['breadcrumbs'][] = ['label' => 'درخواستهای خرید', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form1-create">

    <h2 class="nad-page-title"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
