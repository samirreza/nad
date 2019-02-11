<?php

namespace nad\research\investigation\source\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use nad\research\investigation\source\models\Source;
use nad\research\investigation\source\models\SourceSearch;
use nad\research\investigation\source\models\SourceSearchModel;
use nad\research\investigation\source\actions\ExportSourceGridAction;
use nad\research\investigation\common\controllers\BaseInvestigationController;

class ManageController extends BaseInvestigationController
{
    public function init()
    {
        $this->modelClass = Source::class;
        $this->searchClass = SourceSearch::class;
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
                                'create',
                                'export-source-grid'
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
                                return ['research' => Source::findOne([
                                    'id' => Yii::$app->request->get('id')]
                                )];
                            }
                        ],
                        [
                            'allow' => true,
                            'roles' => ['research.manage']
                        ],
                        [
                            'allow' => true,
                            'actions' => ['report'],
                            'roles' => ['manager']
                        ]
                    ]
                ],
                [
                    'class' => ContentNegotiator::class,
                    'only' => [
                        'set-experts'
                    ],
                    'formats' => [
                        'application/json' => Response::FORMAT_JSON
                    ]
                ]
            ]
        );
    }

    public function actions()
    {
        return [
            'export-source-grid' => [
                'class' => ExportSourceGridAction::class
            ]
        ];
    }

    public function actionSetExperts($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Source::SCENARIO_SET_EXPERTS;
        $model->deliverForProposalDate = time();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'کارشناسان با موفقیت در سیستم درج شدند.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('set-experts', ['model' => $model])
        ]);
        exit;
    }

    public function actionCertificate($id)
    {
        $source = $this->findModel($id);
        return $this->render('certificate', ['source' => $source]);
    }

    public function actionSearch()
    {
        $model = new SourceSearchModel();
        if ($model->load(Yii::$app->request->post())) {
            $searchModel = new SourceSearch();
            $params = [];
            $params[$searchModel->formName()]['title'] = $model->title;
            $params[$searchModel->formName()]['tags'] = $model->tags;
            $dataProvider = $searchModel->search($params);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]);
        } else {
            return $this->render('search', ['model' => $model]);
        }
    }
}
