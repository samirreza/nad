<?php

use nad\build\equipment\unit2\investigation5\method\models\Category;
use nad\build\equipment\unit2\investigation5\reference\models\Reference;
use nad\build\equipment\unit2\investigation5\proposal\models\Proposal;
use nad\build\equipment\unit2\investigation5\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'احداث',
    'تجهیزات',
    ['label' => 'واحد 2', 'url' => ['/build/equipment/unit2/manage/index']],
    ['label' => 'فعالیت ه', 'url' => ['/build/equipment/unit2/manage/investigation5']],
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
