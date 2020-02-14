<?php

use nad\factory\build\unit1\investigation4\method\models\Category;
use nad\factory\build\unit1\investigation4\reference\models\Reference;
use nad\factory\build\unit1\investigation4\proposal\models\Proposal;
use nad\factory\build\unit1\investigation4\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 1', 'url' => ['/factory/build/unit1/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/build/unit1/manage/investigation4']],
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
