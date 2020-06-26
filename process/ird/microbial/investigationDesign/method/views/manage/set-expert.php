<?php

use nad\office\modules\expert\models\Expert;

?>

<?= $this->render('@nad/common/modules/investigation/method/views/method/set-expert', [
    'model' => $model,
    'departmentId' => Expert::DEPARTMENT_PROCESS,
    'permission' => 'expert'
]) ?>
