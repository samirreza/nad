<?php

use nad\process\ird\microbial\investigationDesign\source\models\Category;
use nad\process\ird\microbial\investigationDesign\reference\models\Reference;

$this->title = 'افزودن منشا';
$this->params['breadcrumbs'] = [
    'فرایند',
    'فرایندها',
    ['label' => 'میکروبیولوژی', 'url' => ['/process/ird/microbial/manage/index']],
    ['label' => 'بررسی طراحی', 'url' => ['/process/ird/microbial/manage/investigation-design']],
    'برنامه منشا',
    $this->title
];

?>

<div class="source-create">
    <?= $this->render('@nad/common/modules/investigation/source/views/source/_form', [
        'model' => $model,
        'referenceConsumerCode' => Reference::CONSUMER_CODE,
        'categoryConsumerCode' => Category::CONSUMER_CODE,
    ]) ?>
</div>
