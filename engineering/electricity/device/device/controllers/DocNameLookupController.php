<?php

namespace nad\engineering\electricity\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\electricity\device\device\models\DocNameLookup;
use nad\engineering\electricity\device\device\models\DocNameLookupSearch;
use nad\common\modules\device\controllers\DocNameLookupController as BaseDocNameLookupController;

class DocNameLookupController extends BaseDocNameLookupController
{
    public function init()
    {
        $this->modelClass = DocNameLookup::class;
        $this->searchClass = DocNameLookupSearch::class;
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
                            // 'roles' => ['device.device'],
                            'roles' => ['superuser']
                        ]
                    ]
                ]
            ]
        );
    }
}
