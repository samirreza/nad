<?php

namespace nad\research\modules\project\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\research\modules\project\models\Project;
use nad\research\modules\project\models\ProjectSearch;
use nad\research\common\controllers\BaseResearchController;

class ManageController extends BaseResearchController
{
    public function init()
    {
        $this->modelClass = Project::class;
        $this->searchClass = ProjectSearch::class;
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
                                'update',
                                'delete',
                                'index',
                                'view',
                                'documentation'
                            ],
                            'roles' => [
                                'expert',
                                'research.manageProject'
                            ]
                        ],
                        [
                            'allow' => true,
                            'roles' => ['research.manageProject']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Project([
            'proposalId' => Yii::$app->request->get('proposalId')
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
