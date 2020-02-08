<?php

namespace nad\engineering\geotechnics\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\geotechnics\device\device\models\DeviceInstanceDocument;
use nad\engineering\geotechnics\device\device\models\DeviceInstanceDocumentSearch;
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
                            // 'roles' => ['nad.engineering.geotechnics.device.device']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
