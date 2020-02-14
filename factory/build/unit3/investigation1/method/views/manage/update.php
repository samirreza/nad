<?php

use nad\factory\build\unit3\investigation1\method\models\Category;
use nad\factory\build\unit3\investigation1\reference\models\Reference;
use nad\factory\build\unit3\investigation1\proposal\models\Proposal;
use nad\factory\build\unit3\investigation1\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 3', 'url' => ['/factory/build/unit3/manage/index']],
    ['label' => 'فعالیت الف', 'url' => ['/factory/build/unit3/manage/investigation1']],
    ['label' => 'لیست روش', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="method-update">
    <?= $this->render('@nad/common/modules/investigation/method/views/method/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
        'reportConsumerCode' => Report::CONSUMER_CODE,
    ]) ?>
</div>
