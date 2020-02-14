<?php

namespace nad\factory\production\unit1\investigation3\instruction\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\factory\production\unit1\investigation3\instruction\models\Category;
use nad\factory\production\unit1\investigation3\instruction\models\CategorySearch;
use nad\common\modules\investigation\instruction\controllers\InstructionCategoryController;

class CategoryController extends InstructionCategoryController
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
                        ]
                    ]
                ]
            ]
        );
    }
}
