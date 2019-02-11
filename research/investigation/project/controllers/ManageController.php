<?php

namespace nad\research\investigation\project\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\research\investigation\project\models\Project;
use nad\research\investigation\project\models\ProjectSearch;
use nad\research\investigation\common\controllers\BaseInvestigationController;

class ManageController extends BaseInvestigationController
{
    public function init()
    {
        $this->modelClass = Project::class;
        $this->searchClass = ProjectSearch::class;
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
                            'actions' => [
                                'index',
                                'view',
                                'create'
                            ],
                            'roles' => ['research.expert']
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'update',
                                'delete',
                                'deliver-to-manager'
                            ],
                            'roles' => ['research.manageOwnResearch'],
                            'roleParams' => function() {
                                return ['research' => Project::findOne([
                                    'id' => Yii::$app->request->get('id')]
                                )];
                            }
                        ],
                        [
                            'allow' => true,
                            'roles' => ['research.manage']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actions()
    {
        return [
            'update' => [
                'class' => 'core\tree\actions\UpdateAction',
                'modelClass' => Project::class,
                'isAjax' => false
            ],
            'delete' => [
                'class' => 'core\tree\actions\DeleteAction',
                'modelClass' => Project::class,
                'isAjax' => false
            ]
        ];
    }

    public function actionCreate()
    {
        $model = new Project([
            'proposalId' => Yii::$app->request->get('proposalId')
        ]);
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post())) {
            if ($model->parentId != 0) {
                $parent =  Project::findOne($model->parentId);
                $success = $model->appendTo($parent);
            } else {
                $success = $model->makeRoot();
            }
            if ($success) {
                Yii::$app->session->addFlash(
                    'success',
                    'داده مورد نظر با موفقیت در سیستم درج شد.'
                );
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionCertificate($id)
    {
        $project = $this->findModel($id);
        $proposal = $project->proposal;
        $source = $proposal->source;

        return $this->render('certificate', [
            'source' => $source,
            'proposal' => $proposal,
            'project' => $project
        ]);
    }
}
