<?php

namespace nad\process\ird\ro\investigationMonitor\instruction\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\ro\investigationMonitor\instruction\models\Category;
use nad\process\ird\ro\investigationMonitor\instruction\models\CategorySearch;
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
                            //'roles' => ['ro.investigation']
                        ]
                    ]
                ]
            ]
        );
    }
}
