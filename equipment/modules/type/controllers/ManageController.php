<?php
namespace modules\nad\equipment\modules\type\controllers;

use Yii;
use yii\filters\AccessControl;
use modules\nad\equipment\modules\type\models\Type;
use modules\nad\equipment\modules\type\models\TypeSearch;

class ManageController extends \core\controllers\AdminController
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
                            'roles' => ['equipment.type']
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
