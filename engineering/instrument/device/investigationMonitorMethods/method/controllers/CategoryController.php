<?php

namespace nad\engineering\instrument\device\investigationMonitorMethods\method\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\instrument\device\investigationMonitorMethods\method\models\Category;
use nad\engineering\instrument\device\investigationMonitorMethods\method\models\CategorySearch;
use nad\common\modules\investigation\method\controllers\MethodCategoryController;

class CategoryController extends MethodCategoryController
{
    public function init()
    {
        $this->modelClass = Category::class;
        $this->searchClass = CategorySearch::class;
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
                            'roles' => ['@']
                            //'roles' => ['device.investigationMonitorMethods']
                        ]
                    ]
                ]
            ]
        );
    }
}
