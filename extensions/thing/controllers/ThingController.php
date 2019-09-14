<?php

namespace nad\extensions\thing\controllers;

use yii\db\Query;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;

class ThingController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ]
        ];
    }

    public function actionAjaxFindMaterials($q = null)
    {
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $data = (new Query())
                ->select('id AS id, title AS text')
                ->from('nad_material_type')
                ->where(['like', 'title', $q])
                ->all();
            $out['results'] = array_values($data);
        }
        echo Json::encode($out);
        exit;
    }
}
