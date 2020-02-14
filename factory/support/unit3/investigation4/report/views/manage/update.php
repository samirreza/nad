<?php

use nad\factory\support\unit3\investigation4\report\models\Category;
use nad\factory\support\unit3\investigation4\reference\models\Reference;
use nad\factory\support\unit3\investigation4\proposal\models\Proposal;

$this->title = 'ویرایش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'پشتیبانی',
    ['label' => 'واحد 3', 'url' => ['/factory/support/unit3/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/factory/support/unit3/manage/investigation4']],
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
