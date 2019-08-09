<?php

namespace nad\engineering\mechanics;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/engineering/mechanics/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/engineering/mechanics/investigation');
    }
}
