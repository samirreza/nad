<?php

namespace nad\it\equipment\type\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\it\equipment\type\models\Type;
use nad\it\equipment\type\models\TypeSearch;

class ManageController extends \core\controllers\AjaxAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['it.equipment-type']
                        ],
                    ],
                ],
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Type::className();
        $this->searchClass = TypeSearch::className();
        parent::init();
    }
}
