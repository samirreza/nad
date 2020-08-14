<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model nad\purchase\models\Form2 */

$this->title = 'افزودن بررسی فنی';
$this->params['breadcrumbs'][] = ['label' => 'بررسیهای فنی', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form2-create">

    <h2 class="nad-page-title"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
