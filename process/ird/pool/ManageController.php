<?php

namespace nad\process\ird\pool;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/pool/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/pool/investigation');
    }
}
