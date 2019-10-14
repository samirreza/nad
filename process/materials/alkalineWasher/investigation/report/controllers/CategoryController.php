<?php

namespace nad\process\materials\alkalineWasher\investigation\report\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\materials\alkalineWasher\investigation\report\models\Category;
use nad\process\materials\alkalineWasher\investigation\report\models\CategorySearch;
use nad\common\modules\investigation\report\controllers\ReportCategoryController;

class CategoryController extends ReportCategoryController
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
                            'roles' => ['alkalineWasher.investigation']
                        ]
                    ]
                ]
            ]
        );
    }
}
