<?php

use nad\build\well\unit2\investigation4\source\models\Category;
use nad\build\well\unit2\investigation4\reference\models\Reference;

$this->title = 'افزودن منشا';
$this->params['breadcrumbs'] = [
    'احداث',
    'چاه',
    ['label' => 'واحد 2', 'url' => ['/build/well/unit2/manage/index']],
    ['label' => 'فعالیت د', 'url' => ['/build/well/unit2/manage/investigation4']],
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
