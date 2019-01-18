<?php

namespace nad\research\investigation\common\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\research\extensions\resource\models\Resource;
use nad\research\extensions\resource\models\ResourceSearch;
use nad\research\extensions\resource\controllers\BaseResourceController;

class ResourceController extends BaseResourceController
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

        return $this->render('@nad/research/extensions/resource/views/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'clientId' => Resource::CLIENT_INVESTIGATION,
            'clientTitle' => 'بررسی'
        ]);
    }
}
