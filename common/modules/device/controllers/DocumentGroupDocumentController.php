<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\DocumentGroup;
use nad\common\modules\device\models\DocumentGroupSearch;

class DocumentGroupDocumentController extends \core\controllers\AjaxAdminController
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
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'delete',
                                'update'
                            ],
                            'roles' => ['@']
                        ]
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = DocumentGroup::className();
        $this->searchClass = DocumentGroupSearch::className();
        parent::init();
    }

    public function actionIndex()
    {
        $groupId = Yii::$app->request->queryParams['DocumentGroupDocumentSearch']['groupId'];
        $groupModel = DocumentGroup::findOne($groupId);
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'groupModel' => $groupModel
        ]);
    }

    // public function getViewPath()
    // {
    //     return Yii::getAlias('@nad/common/modules/engineering/device/views/manage');
    // }
}
