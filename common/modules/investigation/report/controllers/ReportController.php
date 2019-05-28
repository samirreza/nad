<?php

namespace nad\common\modules\investigation\report\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use nad\common\modules\investigation\report\models\Report;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class ReportController extends BaseInvestigationController
{
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'update',
                                'delete',
                                'deliver-to-manager'
                            ],
                            'roles' => ['investigation.manageOwnInvestigation'],
                            'roleParams' => function() {
                                return ['investigation' => Report::findOne([
                                    'id' => Yii::$app->request->get('id')]
                                )];
                            }
                        ]
                    ]
                ]
            ]
        );
    }
}
