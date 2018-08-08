<?php
namespace modules\nad\equipment\modules\type\controllers;

use Yii;
use yii\filters\AccessControl;
use modules\nad\equipment\modules\type\models\Category;
use modules\nad\equipment\modules\type\models\CategorySearch;

class CategoryController extends \core\controllers\AdminController
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
                            'roles' => ['equipment.type'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Category::className();
        $this->searchClass = CategorySearch::className();
        parent::init();
    }
}
