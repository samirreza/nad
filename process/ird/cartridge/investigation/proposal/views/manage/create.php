<?php

use nad\process\ird\cartridge\investigation\proposal\models\Proposal;

$this->title = 'درج پروپوزال';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'کارتریج', 'url' => ['/cartridge/manage/index']],
    ['label' => 'بررسی', 'url' => ['/cartridge/manage/investigation']],
    $this->title
];

?>

<div class="proposal-create">
    <?= $this->render('@nad/common/modules/investigation/proposal/views/proposal/_form', [
        'model' => $model,
        'consumer' => Proposal::CONSUMER_CODE
    ]) ?>
</div>
