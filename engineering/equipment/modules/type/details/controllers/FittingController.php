<?php

namespace nad\engineering\equipment\modules\type\details\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use core\controllers\AjaxAdminController;
use nad\engineering\equipment\modules\type\models\Type;
use nad\engineering\equipment\modules\type\details\models\Fitting;
use nad\engineering\equipment\modules\type\details\models\FittingSearch;

class FittingController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Fitting::class;
        $this->searchClass = FittingSearch::class;
        parent::init();
    }

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
                            'roles' => ['equipment.type']
                        ]
                    ]
                ]
            ]
        );
    }

    public function beforeAction($action)
    {
        if ($action->id == 'index') {
            $typeId = Yii::$app->request->get('typeId');
            if (null == $typeId || null == Type::findOne($typeId)) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        return parent::beforeAction($action);
    }
}
