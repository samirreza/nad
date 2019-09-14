<?php

namespace nad\process\ird\ro;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/ro/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/ro/investigation');
    }
}
