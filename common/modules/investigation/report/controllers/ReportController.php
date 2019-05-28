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

    public function actions()
    {
        return [            
            'generate-graph' => [
                'class' => 'nad\extensions\graphGenerator\actions\GenerateGraphAction',
                'modelClassName' => Report::class,
            ],
        ];
    }

    public function actionCertificate($id)
    {
        $report = $this->findModel($id);
        $proposal = $report->proposal;
        $source = $proposal->source;

        return $this->render('certificate', [
            'source' => $source,
            'proposal' => $proposal,
            'report' => $report
        ]);
    }
}
