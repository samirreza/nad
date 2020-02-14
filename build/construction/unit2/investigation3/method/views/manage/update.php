<?php

use nad\build\construction\unit2\investigation3\method\models\Category;
use nad\build\construction\unit2\investigation3\reference\models\Reference;
use nad\build\construction\unit2\investigation3\proposal\models\Proposal;
use nad\build\construction\unit2\investigation3\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'احداث',
    'ساختمان',
    ['label' => 'واحد 2', 'url' => ['/build/construction/unit2/manage/index']],
    ['label' => 'فعالیت ج', 'url' => ['/build/construction/unit2/manage/investigation3']],
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
