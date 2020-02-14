<?php

use nad\temporary\financial\unit3\investigation2\method\models\Category;
use nad\temporary\financial\unit3\investigation2\reference\models\Reference;
use nad\temporary\financial\unit3\investigation2\proposal\models\Proposal;
use nad\temporary\financial\unit3\investigation2\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'موقت',
    'مالی',
    ['label' => 'واحد 3', 'url' => ['/temporary/financial/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/temporary/financial/unit3/manage/investigation2']],
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
