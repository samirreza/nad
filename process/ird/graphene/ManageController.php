<?php

namespace nad\process\ird\graphene;

class ManageController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('@nad/process/ird/graphene/index');
    }

    public function actionInvestigation()
    {
        return $this->render('@nad/process/ird/graphene/investigation');
    }
}
