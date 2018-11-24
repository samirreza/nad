<?php

namespace nad\research\modules\proposal\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\research\modules\proposal\models\Proposal;
use nad\research\modules\proposal\models\ProposalSearch;
use nad\research\common\controllers\BaseResearchController;

class ManageController extends BaseResearchController
{
    public function init()
    {
        $this->modelClass = Proposal::class;
        $this->searchClass = ProposalSearch::class;
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['create', 'deliver-to-manager'],
                            'roles' => ['expert']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'index',
                                'view',
                                'update',
                                'delete',
                                'documentation'
                            ],
                            'roles' => [
                                'expert',
                                'research.manageProposals'
                            ]
                        ],
                        [
                            'allow' => true,
                            'roles' => ['research.manageProposals']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Proposal([
            'sourceId' => Yii::$app->request->get('sourceId')
        ]);
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'داده مورد نظر با موفقیت در سیستم درج شد.'
            );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
}
