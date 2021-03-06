<?php

namespace nad\process\ird\hydraulic\investigation\method\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\hydraulic\investigation\method\models\Category;
use nad\process\ird\hydraulic\investigation\method\models\CategorySearch;
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
                            //'roles' => ['hydraulic.investigation']
                        ]
                    ]
                ]
            ]
        );
    }
}
