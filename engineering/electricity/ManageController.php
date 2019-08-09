<?php

namespace nad\engineering\electricity;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/engineering/electricity/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/engineering/electricity/investigation');
    }
}
