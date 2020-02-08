<?php

namespace nad\engineering\mechanics\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\mechanics\device\device\models\DevicePartDocument;
use nad\engineering\mechanics\device\device\models\DevicePartDocumentSearch;
use nad\common\modules\device\controllers\DevicePartDocumentController as ParentController;

class DevicePartDocumentController extends ParentController
{
    public function init()
    {
        $this->modelClass = DevicePartDocument::class;
        $this->searchClass = DevicePartDocumentSearch::class;
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
                            // 'roles' => ['nad.engineering.mechanics.device.device']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
