<?php

namespace nad\common\modules\investigation\reference\controllers;

use yii\filters\AccessControl;
use core\controllers\AjaxAdminController;

class ReferenceController extends AjaxAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['superuser']
                        ]
                    ]
                ]
            ]
        );
    }
}
