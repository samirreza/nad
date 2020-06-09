<?php

namespace nad\engineering\equipment\modules\type\details\controllers;

use Yii;
use yii\web\Response;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use core\controllers\AjaxAdminController;
use nad\engineering\equipment\modules\type\models\Type;
use nad\engineering\equipment\modules\type\details\models\Part;
use nad\engineering\equipment\modules\type\details\models\PartSearch;

class PartController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Part::class;
        $this->searchClass = PartSearch::class;
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
                            'roles' => ['@']
                            //'roles' => ['equipment.type']
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

    public function actionAjaxFindParts($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $parts = Part::find()
            ->select(['id', 'title', 'uniqueCode'])
            ->where(['or', ['like', 'title', $q], ['like', 'uniqueCode', $q]])
            ->all();
        $output['results'] = [];
        foreach ($parts as $part) {
            $output['results'][] = [
                'id' => $part->title,
                'text' => $part->uniqueCode . ' (' . $part->title . ') '
            ];
        }

        return $output;
    }
}
