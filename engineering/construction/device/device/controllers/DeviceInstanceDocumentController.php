<?php

namespace nad\engineering\construction\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\construction\device\device\models\DeviceInstanceDocument;
use nad\engineering\construction\device\device\models\DeviceInstanceDocumentSearch;
use nad\common\modules\device\controllers\DeviceInstanceDocumentController as ParentController;

class DeviceInstanceDocumentController extends ParentController
{
    public function init()
    {
        $this->modelClass = DeviceInstanceDocument::class;
        $this->searchClass = DeviceInstanceDocumentSearch::class;
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
                            // 'roles' => ['nad.engineering.construction.device.device']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
