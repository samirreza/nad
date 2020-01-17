<?php

namespace nad\engineering\piping\device\device\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\piping\device\device\models\Category;
use nad\engineering\piping\device\device\models\CategorySearch;
use nad\common\modules\device\controllers\CategoryController as BaseCategoryController;

class CategoryController extends BaseCategoryController
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
                            // 'roles' => ['device.device'],
                            'roles' => ['device.device']
                        ],
                        [
                            'allow' => false,
                            'actions' => [
                                'create',
                                'update',
                                'delete',
                            ],
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
