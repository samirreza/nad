<?php

namespace nad\common\modules\excelmanager\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\data\ArrayDataProvider;
use nad\common\modules\excelmanager\models\ExcelFile;
use nad\common\modules\excelmanager\models\ExcelFileSearch;

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
                            'actions' => [
                                'index',
                                'view',
                                'create',
                                'update',
                                'delete',
                            ],
                            'roles' => ['@']
                        ],
                    ]
                ]
            ]
        );
    }

    public function init()
    {
        $this->modelClass = ExcelFile::className();
        $this->searchClass = ExcelFileSearch::className();
        parent::init();
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $selectSql = "select JSON_QUERY(fileData, '$.rows') as fileRows from " . ExcelFile::tableName();
        $rowsRaw = Yii::$app->db->createCommand($selectSql)->queryOne();

        $rows = Json::decode($rowsRaw['fileRows']);
        $columns = [];
        if (isset($rows[0])) {
            $columnNames = array_keys($rows[0]);
            foreach ($columnNames as $name) {
                $tmp = [];
                $tmp['attribute'] = $name;

                $columns[] = $tmp;
            }
        }else{
            $rows = [];
        }

        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            // 'sort' => [
            //     'attributes' => ['id', 'username', 'email'],
            // ],
            'pagination' => [
                'pageSize' => 50,
            ],
        ]);

        return $this->render('view',
            [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'columns'=>$columns
            ]
        );
    }
}
