<?php

namespace modules\nad\equipment\modules\type\controllers;

use yii\filters\AccessControl;
use modules\nad\equipment\modules\type\models\Type;
use modules\nad\equipment\modules\type\models\TypeSearch;

class ManageController extends \core\controllers\AdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['equipment.type']
                        ],
                    ],
                ],
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Type::className();
        $this->searchClass = TypeSearch::className();
        parent::init();
    }

    public function actionAjaxFindEquipments($q = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $equipments['results'] = [];
        $index = 0;

        $types = Type::find()
            ->where(['like', 'title', $q])
            ->all();

        foreach ($types as $type) {
            $equipments['results'][$index] =
                [
                    'id' => $type->title,
                    'text' => $type->compositeCode . ' ( ' . $type->title . ' ) ',
                ];
            $index++;
        }
        return $equipments;
    }
}