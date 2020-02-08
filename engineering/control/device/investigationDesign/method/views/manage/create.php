<?php

use nad\engineering\control\device\investigationDesign\method\models\Category;
use nad\engineering\control\device\investigationDesign\reference\models\Reference;
use nad\engineering\control\device\investigationDesign\proposal\models\Proposal;
use nad\engineering\control\device\investigationDesign\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فنی',
    'کنترل',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/control/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/control/device/manage/investigation-design']],
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
