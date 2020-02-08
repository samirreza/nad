<?php

use nad\engineering\instrument\device\investigationDesign\method\models\Category;
use nad\engineering\instrument\device\investigationDesign\reference\models\Reference;
use nad\engineering\instrument\device\investigationDesign\proposal\models\Proposal;
use nad\engineering\instrument\device\investigationDesign\report\models\Report;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'فنی',
    'ابزار دقیق',
    ['label' => 'دستگاه ها', 'url' => ['/engineering/instrument/device/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/engineering/instrument/device/manage/investigation-design']],
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
