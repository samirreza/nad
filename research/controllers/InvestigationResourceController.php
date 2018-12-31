<?php

namespace nad\research\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\research\modules\resource\models\Resource;
use nad\research\modules\resource\models\ResourceSearch;

class InvestigationResourceController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['research.expert', 'research.manage']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ResourceSearch();
        $params = Yii::$app->request->queryParams;
        $params[$searchModel->formName()]['clientId'] = Resource::CLIENT_INVESTIGATION;
        $dataProvider = $searchModel->search($params);

        return $this->render('@nad/research/modules/resource/views/manage/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'clientId' => Resource::CLIENT_INVESTIGATION
        ]);
    }
}
