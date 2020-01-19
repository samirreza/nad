<?php

namespace nad\common\modules\device\controllers;

use Yii;
use yii\filters\AccessControl;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\Document;
use nad\common\modules\device\models\DeviceSearch;
use nad\common\modules\device\models\Category;

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
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'delete',
                                'update',
                                'tree-list',
                                'get-json-tree',
                                'get-device-title-and-code'
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
        $this->modelClass = Device::className();
        $this->searchClass = DeviceSearch::className();
        parent::init();
    }

    public function actionTreeList()
    {
        return $this->render('tree');
    }


    public function actionGetJsonTree($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $roots = Category::find()->roots()->all();
        $tree = [];
        $reversedRoots = array_reverse($roots); // don't know why?!
        foreach ($reversedRoots as $root) {
            $tree[] = $root->getFamilyTreeArrayForWidget();
        }
        return $tree;
    }

    public function actionIndex()
    {
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionGetDeviceTitleAndCode($deviceId){
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $deviceCategory = Category::findOne(['id' => $deviceId]);

        if(isset($deviceCategory)){
            return [
                'familyTreeTitle' => $deviceCategory->familyTreeTitle,
                'code' => $deviceCategory->code
            ];
        }else{
            return 'نام دستگاه مشخص نیست!';
        }
    }
}
