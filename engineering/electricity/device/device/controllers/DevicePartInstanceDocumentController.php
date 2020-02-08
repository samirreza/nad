<?php

namespace nad\engineering\electricity\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\electricity\device\device\models\DevicePartInstanceDocument;
use nad\engineering\electricity\device\device\models\DevicePartInstanceDocumentSearch;
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
                            // 'roles' => ['nad.engineering.electricity.device.device']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
