<?php

namespace nad\research\modules\source\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use core\controllers\AdminController;
use nad\research\modules\source\models\Source;
use nad\research\modules\source\models\SourceSearch;
use nad\extensions\documentation\actions\DocumentationAction;

class ManageController extends AdminController
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
                            'actions' => ['index', 'create', 'upate', 'delete'],
                            'roles' => [
                                'research.createSource',
                                'research.manageSource'
                            ]
                        ],
                        [
                            'allow' => true,
                            'actions' => ['set-session-date'],
                            'roles' => ['research.manageSource']
                        ],
                        [
                            'allow' => true,
                            'roles' => ['research.manageSource']
                        ]
                    ]
                ],
                [
                    'class' => ContentNegotiator::class,
                    'only' => [
                        'change-status',
                        'deliver-to-manager',
                        'set-session-date',
                        'accept',
                        'set-expert'
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
            'documentation' => [
                'class' => DocumentationAction::class,
                'modelClassName' => Source::class
            ]
        ];
    }

    public function actionChangeStatus($id, $newStatus)
    {
        $source = $this->findModel($id)->changeStatus($newStatus);
        echo Json::encode([
            'status' => 'success',
            'message' => 'منشا ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
        ]);
        exit;
    }

    public function actionDeliverToManager($id)
    {
        $source = $this->findModel($id);
        $source->changeStatus(Source::STATUS_DELIVERED_TO_MANAGER);
        $source->deliverToManagerDate = time();
        $source->save();
        echo Json::encode([
            'status' => 'success',
            'message' => 'منشا ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
        ]);
        exit;
    }

    public function actionSetSessionDate($id)
    {
        $source = $this->findModel($id);
        if ($source->load(Yii::$app->request->post())) {
            $source->status = Source::STATUS_WAITING_FOR_MEETING;
            if ($source->save()) {
                echo Json::encode([
                    'status' => 'success',
                    'message' => 'منشا ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
                ]);
                exit;
            }
        }
        echo Json::encode([
            'content' => $this->renderAjax('set-session-date', [
                'source' => $source
            ])
        ]);
        exit;
    }

    public function actionSetExpert($id)
    {
        $source = $this->findModel($id);
        if ($source->load(Yii::$app->request->post()) && $source->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'منشا ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('set-expert', [
                'source' => $source
            ])
        ]);
        exit;
    }
}
