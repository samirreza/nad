<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nad\purchase\models\Form3 */

$this->title = 'افزودن بررسی بازرگانی';
$this->params['breadcrumbs'][] = ['label' => 'بررسیهای بازرگانی', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form3-create">

    <h2 class="nad-page-title"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
