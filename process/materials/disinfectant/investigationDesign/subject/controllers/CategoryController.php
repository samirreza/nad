<?php

namespace nad\process\materials\disinfectant\investigationDesign\subject\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\materials\disinfectant\investigationDesign\subject\models\Category;
use nad\process\materials\disinfectant\investigationDesign\subject\models\CategorySearch;
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
                            'roles' => ['disinfectant.investigationDesign']
                        ]
                    ]
                ]
            ]
        );
    }
}
