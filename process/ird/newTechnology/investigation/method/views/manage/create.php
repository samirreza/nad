<?php

use nad\process\ird\newTechnology\investigation\method\models\Category;
use nad\process\ird\newTechnology\investigation\reference\models\Reference;
use nad\process\ird\newTechnology\investigation\proposal\models\Proposal;
use nad\process\ird\newTechnology\investigation\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'تکنولوژی های نو', 'url' => ['/process/ird/newTechnology/manage/index']],
    ['label' => 'بررسی فرایندی', 'url' => ['/process/ird/newTechnology/manage/investigation']],
    $this->title
];

?>

<div class="method-create">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
    ]) ?>
</div>
