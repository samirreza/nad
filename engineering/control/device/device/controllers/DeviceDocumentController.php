<?php

namespace nad\engineering\control\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\control\device\device\models\DeviceDocument;
use nad\engineering\control\device\device\models\DeviceDocumentSearch;
use nad\common\modules\device\controllers\DeviceDocumentController as ParentController;

class DeviceDocumentController extends ParentController
{
    public function init()
    {
        $this->modelClass = DeviceDocument::class;
        $this->searchClass = DeviceDocumentSearch::class;
    }

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
                                'index',
                                'view',
                                'create',
                                'update'
                            ],
                            // 'roles' => ['nad.engineering.control.device.device']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
