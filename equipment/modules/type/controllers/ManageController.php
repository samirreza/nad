<?php

namespace modules\nad\equipment\modules\type\controllers;

use modules\nad\equipment\modules\type\details\models\Part;
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

        $types = Type::find()
            ->select(['id', 'title', 'uniqueCode'])
            ->where(['or', ['like', 'title', $q], ['like', 'uniqueCode', $q]])
            ->all();

        $equipments['results'] = [];
        foreach ($types as $type) {
            $equipments['results'][] = [
                'id' => $type->title,
                'text' => $type->uniqueCode . ' (' . $type->title . ') ',
            ];
        }
        return $equipments;
    }
}
