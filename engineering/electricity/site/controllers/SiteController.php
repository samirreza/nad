<?php

namespace nad\engineering\electricity\site\controllers;

use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\engineering\electricity\site\models\Site;
use nad\engineering\electricity\site\models\SiteSearch;
use nad\common\modules\site\controllers\SiteController as ParentController;

class SiteController extends ParentController
{
    public function init()
    {
        $this->modelClass = Site::class;
        $this->searchClass = SiteSearch::class;
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
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'update'
                            ],
                            // 'roles' => ['nad.engineering.electricity.site']
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }
}
