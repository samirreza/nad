<?php

namespace nad\engineering\electricity\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\electricity\device\device\models\DocumentGroup;
use nad\engineering\electricity\device\device\models\DocumentGroupSearch;
use nad\common\modules\device\controllers\DocumentGroupController as ParentController;

class DocumentGroupController extends ParentController
{
    public function init()
    {
        $this->modelClass = DocumentGroup::class;
        $this->searchClass = DocumentGroupSearch::class;
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
