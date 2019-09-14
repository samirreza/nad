<?php

namespace nad\engineering\construction;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/engineering/construction/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/engineering/construction/investigation');
    }
}
