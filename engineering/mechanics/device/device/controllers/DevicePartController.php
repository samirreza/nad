<?php

namespace nad\engineering\mechanics\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\mechanics\device\device\models\DevicePart;
use nad\engineering\mechanics\device\device\models\DevicePartSearch;
use nad\common\modules\device\controllers\DevicePartController as ParentController;

class DevicePartController extends ParentController
{
    public function init()
    {
        $this->modelClass = DevicePart::class;
        $this->searchClass = DevicePartSearch::class;
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
