<?php

use nad\factory\build\unit3\investigation2\report\models\Category;
use nad\factory\build\unit3\investigation2\reference\models\Reference;
use nad\factory\build\unit3\investigation2\proposal\models\Proposal;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'کارخانه',
    'احداث',
    ['label' => 'واحد 3', 'url' => ['/factory/build/unit3/manage/index']],
    ['label' => 'فعالیت ب', 'url' => ['/factory/build/unit3/manage/investigation2']],
    $this->title
];

?>

<div class="report-create">
    <?= $this->render('@nad/common/modules/investigation/report/views/report/_form', [
        'model' => $model,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'proposalConsumerCode' => Proposal::CONSUMER_CODE,
    ]) ?>
</div>
