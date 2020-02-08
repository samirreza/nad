<?php

namespace nad\engineering\control\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\control\device\device\models\Device;
use nad\engineering\control\device\device\models\DeviceSearch;
use nad\common\modules\device\controllers\ManageController as ParentController;

class ManageController extends ParentController
{
    public function init()
    {
        $this->modelClass = Device::class;
        $this->searchClass = DeviceSearch::class;
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
