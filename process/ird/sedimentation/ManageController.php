<?php

namespace nad\process\ird\sedimentation;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/sedimentation/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/sedimentation/investigation');
    }
}
