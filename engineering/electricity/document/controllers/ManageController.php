<?php

namespace nad\engineering\electricity\document\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\electricity\document\models\Document;
use nad\engineering\electricity\document\models\DocumentSearch;
use nad\common\modules\engineering\document\controllers\ManageController as ParentController;

class ManageController extends ParentController
{
    public function init()
    {
        $this->modelClass = Document::class;
        $this->searchClass = DocumentSearch::class;
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
                            // 'roles' => ['nad.engineering.electricity.document']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
