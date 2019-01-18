<?php

namespace nad\research\investigation\source\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use nad\research\investigation\source\models\Source;
use nad\research\investigation\source\models\SourceSearch;
use nad\research\investigation\common\controllers\BaseInvestigationController;

class ManageController extends BaseInvestigationController
{
    public function init()
    {
        $this->modelClass = Source::class;
        $this->searchClass = SourceSearch::class;
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
}
