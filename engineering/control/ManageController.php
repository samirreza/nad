<?php

namespace nad\engineering\control;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/engineering/control/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/engineering/control/investigation');
    }
}
