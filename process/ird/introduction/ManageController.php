<?php

namespace nad\process\ird\introduction;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/introduction/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/introduction/investigation');
    }
}
