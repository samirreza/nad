<?php

namespace nad\process\ird\microbial;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/microbial/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/microbial/investigation');
    }
}
