<?php

namespace nad\common\modules\investigation\method\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use nad\common\modules\investigation\method\models\Method;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class MethodController extends BaseInvestigationController
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
                                return ['investigation' => Method::findOne([
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
