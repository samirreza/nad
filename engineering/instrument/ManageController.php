<?php

namespace nad\engineering\instrument;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/engineering/instrument/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/engineering/instrument/investigation');
    }
}
