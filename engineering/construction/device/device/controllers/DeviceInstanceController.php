<?php

namespace nad\engineering\construction\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\construction\device\device\models\DeviceInstance;
use nad\engineering\construction\device\device\models\DeviceInstanceSearch;
use nad\common\modules\device\controllers\DeviceInstanceController as ParentController;

class DeviceInstanceController extends ParentController
{
    public function init()
    {
        $this->modelClass = DeviceInstance::class;
        $this->searchClass = DeviceInstanceSearch::class;
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
