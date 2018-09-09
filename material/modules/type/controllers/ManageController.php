<?php

namespace modules\nad\material\modules\type\controllers;

use Yii;
use yii\filters\AccessControl;
use modules\nad\material\modules\type\models\Type;
use modules\nad\material\modules\type\models\TypeSearch;

class ManageController extends \core\controllers\AjaxAdminController
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
                            'roles' => ['material.type']
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

    public function actionAjaxFindMaterials($q = null)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $materials['results'] = [];
        $index = 0;

        $types = Type::find()
            ->where(['like', 'title', $q])
            ->all();

        foreach ($types as $type) {
            $materials['results'][$index] =
                [
                    'id' => $type->title,
                    'text' => $type->compositeCode . ' ( ' . $type->title . ' ) ',
                ];
            $index++;
        }
        return $materials;
    }
}
