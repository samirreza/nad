<?php

namespace nad\engineering\geotechnics\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\geotechnics\device\device\models\DeviceCategoryDocument;
use nad\engineering\geotechnics\device\device\models\DeviceCategoryDocumentSearch;
use nad\common\modules\device\controllers\DeviceCategoryDocumentController as ParentController;

class DeviceCategoryDocumentController extends ParentController
{
    public function init()
    {
        $this->modelClass = DeviceCategoryDocument::class;
        $this->searchClass = DeviceCategoryDocumentSearch::class;
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
