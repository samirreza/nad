<?php

namespace nad\engineering\mechanics\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\mechanics\device\device\models\DocumentGroupDocument;
use nad\engineering\mechanics\device\device\models\DocumentGroupDocumentSearch;
use nad\common\modules\device\controllers\DocumentGroupDocumentController as ParentController;

class DocumentGroupDocumentController extends ParentController
{
    public function init()
    {
        $this->modelClass = DocumentGroupDocument::class;
        $this->searchClass = DocumentGroupDocumentSearch::class;
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
                            // 'roles' => ['nad.engineering.mechanics.document']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
