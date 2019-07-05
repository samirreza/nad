<?php

namespace nad\process\ird\wastewater;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/wastewater/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/wastewater/investigation');
    }
}
