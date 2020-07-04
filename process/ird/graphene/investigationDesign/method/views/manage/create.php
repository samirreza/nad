<?php

use nad\process\ird\graphene\investigationDesign\method\models\Category;
use nad\process\ird\graphene\investigationDesign\reference\models\Reference;
use nad\process\ird\graphene\investigationDesign\proposal\models\Proposal;
use nad\process\ird\graphene\investigationDesign\report\models\Report;

$this->title = 'افزودن روش';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'گرافن', 'url' => ['/process/ird/graphene/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/process/ird/graphene/manage/investigation-design']],
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
