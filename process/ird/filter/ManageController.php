<?php

namespace nad\process\ird\filter;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/filter/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/filter/investigation');
    }
}
