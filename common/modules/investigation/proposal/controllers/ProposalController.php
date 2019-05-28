<?php

namespace nad\common\modules\investigation\proposal\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use nad\common\modules\investigation\proposal\models\Proposal;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class ProposalController extends BaseInvestigationController
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
                                return ['investigation' => Proposal::findOne([
                                    'id' => Yii::$app->request->get('id')]
                                )];
                            }
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionSetExpert($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Proposal::SCENARIO_SET_EXPERT;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'کارشناس با موفقیت در سیستم درج شد.'
            );
            return $this->redirect(['view', 'id' => $id]);
        }
        echo Json::encode([
            'content' => $this->renderAjax('set-expert', ['model' => $model])
        ]);
        exit;
    }
}
