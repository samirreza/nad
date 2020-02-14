<?php

namespace nad\temporary\informationtech\unit2\investigation4\proposal\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\temporary\informationtech\unit2\investigation4\proposal\models\Category;
use nad\temporary\informationtech\unit2\investigation4\proposal\models\CategorySearch;
use nad\common\modules\investigation\proposal\controllers\ProposalCategoryController;

class CategoryController extends ProposalCategoryController
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
