<?php

use nad\engineering\control\stage\investigationImprovement\method\models\Category;
use nad\engineering\control\stage\investigationImprovement\reference\models\Reference;
use nad\engineering\control\stage\investigationImprovement\proposal\models\Proposal;
use nad\engineering\control\stage\investigationImprovement\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'مراحل', 'url' => ['/engineering/control/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/control/stage/manage/investigation-improvement']],
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
