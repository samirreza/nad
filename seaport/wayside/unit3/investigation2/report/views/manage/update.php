<?php

use nad\seaport\wayside\unit3\investigation2\report\models\Category;
use nad\seaport\wayside\unit3\investigation2\reference\models\Reference;
use nad\seaport\wayside\unit3\investigation2\proposal\models\Proposal;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'بندر',
    'واحد بندر',
    ['label' => 'واحد 3', 'url' => ['/seaport/wayside/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/seaport/wayside/unit3/manage/investigation2']],
    ['label' => 'لیست گزارش', 'url' => ['index']],
    ['label' => $model->title, 'url' => ['view', 'id' => $model->id]],
    $this->title
];

?>

<div class="report-update">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
    ]) ?>
</div>
