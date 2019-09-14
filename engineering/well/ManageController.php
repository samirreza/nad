<?php

namespace nad\engineering\well;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/engineering/well/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/engineering/well/investigation');
    }
}
