<?php

namespace nad\engineering\piping\stage\investigationImprovement\subject\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\piping\stage\investigationImprovement\subject\models\Category;
use nad\engineering\piping\stage\investigationImprovement\subject\models\CategorySearch;
use nad\common\modules\investigation\subject\controllers\SubjectCategoryController;

class CategoryController extends SubjectCategoryController
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
                            'roles' => ['stage.investigationImprovement']
                        ]
                    ]
                ]
            ]
        );
    }
}
