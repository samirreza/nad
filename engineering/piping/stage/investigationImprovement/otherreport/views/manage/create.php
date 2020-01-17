<?php

use nad\engineering\piping\stage\investigationImprovement\otherreport\models\Category;
use nad\engineering\piping\stage\investigationImprovement\reference\models\Reference;
use nad\engineering\piping\stage\investigationImprovement\subject\models\Subject;

$this->title = 'افزودن گزارش';
$this->params['breadcrumbs'] = [
    'فنی',
    'لوله کشی',
    ['label' => 'مراحل', 'url' => ['/engineering/piping/stage/manage/index']],
    ['label' => 'بررسی بهبود', 'url' => ['/engineering/piping/stage/manage/investigation-improvement']],
    $this->title
];

?>

<div class="otherreport-create">
    <?= $this->render('@nad/common/modules/investigation/otherreport/views/otherreport/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'subjectConsumerCode' => Subject::CONSUMER_CODE,
    ]) ?>
</div>