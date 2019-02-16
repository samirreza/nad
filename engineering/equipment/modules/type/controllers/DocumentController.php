<?php

namespace nad\engineering\equipment\modules\type\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;
use nad\engineering\equipment\modules\type\models\Document;
use nad\engineering\equipment\modules\type\models\DocumentSearch;

class DocumentController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Document::class;
        $this->searchClass = DocumentSearch::class;
        parent::init();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['equipment.type']
                        ]
                    ]
                ]
            ]
        );
    }
}
