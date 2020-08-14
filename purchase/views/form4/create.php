<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nad\purchase\models\Form4 */

$this->title = 'افزودن درخواست وجه';
$this->params['breadcrumbs'][] = ['label' => 'درخواستهای وجه', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form4-create">

    <h2 class="nad-page-title"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
