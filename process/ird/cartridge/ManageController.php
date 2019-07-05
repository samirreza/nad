<?php

namespace nad\process\ird\cartridge;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/cartridge/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/cartridge/investigation');
    }
}
