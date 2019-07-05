<?php

use nad\process\ird\introduction\investigation\proposal\models\Proposal;

$this->title = 'درج پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'بررسی، پایش و طراحی',
    ['label' => 'آشنایی', 'url' => ['/introduction/manage/index']],
    ['label' => 'بررسی', 'url' => ['/introduction/manage/investigation']],
    $this->title
];

?>

<div class="proposal-create">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/_form', [
        'model' => $model,
        'consumer' => Proposal::CONSUMER_CODE
    ]) ?>
</div>
