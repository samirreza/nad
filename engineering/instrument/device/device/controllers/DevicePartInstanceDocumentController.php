<?php

namespace nad\engineering\instrument\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\instrument\device\device\models\DevicePartInstanceDocument;
use nad\engineering\instrument\device\device\models\DevicePartInstanceDocumentSearch;
use nad\common\modules\device\controllers\DevicePartInstanceDocumentController as ParentController;

class DevicePartInstanceDocumentController extends ParentController
{
    public function init()
    {
        $this->modelClass = DevicePartInstanceDocument::class;
        $this->searchClass = DevicePartInstanceDocumentSearch::class;
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
                            // 'roles' => ['nad.engineering.instrument.device.device']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
