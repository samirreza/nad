<?php

use nad\office\modules\expert\models\Expert;

?>

<?= $this->render('@nad/common/modules/investigation/source/views/source/set-experts', [
    'model' => $model,
    'departmentId' => Expert::DEPARTMENT_PROCESS,
    'permission' => 'expert'
]) ?>
