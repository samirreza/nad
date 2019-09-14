<?php

namespace nad\process\ird\newTechnology;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/newTechnology/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/newTechnology/investigation');
    }
}
