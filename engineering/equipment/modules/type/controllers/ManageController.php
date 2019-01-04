<?php

namespace nad\engineering\equipment\modules\type\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use core\controllers\AdminController;
use nad\engineering\equipment\modules\type\models\Type;
use nad\engineering\equipment\modules\type\models\TypeSearch;

class ManageController extends AdminController
{
    public function init()
    {
        $this->modelClass = Type::class;
        $this->searchClass = TypeSearch::class;
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

    public function actionAjaxFindEquipments($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $types = Type::find()
            ->select(['id', 'title', 'uniqueCode'])
            ->where(['or', ['like', 'title', $q], ['like', 'uniqueCode', $q]])
            ->all();

        $equipments['results'] = [];
        foreach ($types as $type) {
            $equipments['results'][] = [
                'id' => $type->title,
                'text' => $type->uniqueCode . ' (' . $type->title . ') '
            ];
        }

        return $equipments;
    }

    public function actionMaterial()
    {
        return $this->render('@theme/views/site/construction.html');
    }
}
