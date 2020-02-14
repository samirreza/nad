<?php
use nad\engineering\geotechnics\device\device\models\Category;
?>
<?= $this->render('@nad/common/modules/device/views/manage/_form', [
    'model' => $model,
    'categoryConsumerCode' => Category::CONSUMER_CODE
]);