<?php

namespace nad\common\modules\excelmanager\controllers;

use Yii;
use yii\helpers\Html;
use yii\filters\AccessControl;
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
                            ],
                            'roles' => ['@']
                        ],
                    ]
                ]
            ]
        );
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $rows = $model->getRows($model->id);
        $columns = $model->getColumns($rows);
        $dataProvider = $model->getArrayDataProvider($rows);

        return $this->render('view',
            [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'columns' => $columns
            ]
        );
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!empty($this->modelScenario)) {
            $model->scenario = $this->modelScenario;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $rows = Yii::$app->request->post('rows');

            if(isset($rows) && !empty($rows)){
                $updateSql = "update " . ExcelFile::tableName() ." set fileData = JSON_REPLACE(fileData, ";

                foreach ($rows as $rowNum => $row) {
                    foreach ($row as $key => $value) {
                        $columnName = Html::decode($key);
                        $columnValue = $value;

                        $updateSql .= "'$.rows[{$rowNum}].\"{$columnName}\"', '" . $columnValue . "', ";
                    }
                }
                $updateSql = trim($updateSql, ', ');
                $updateSql .= ')  where id = :id';
                Yii::$app->db->createCommand($updateSql)->bindValues([':id' => $model->id])->execute();
            }

            Yii::$app->session->addFlash(
                'success',
                'آیتم ویرایش شده با موفقیت در سیستم به روز رسانی شد.'
            );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $rows = $model->getRows($model->id);
            $columns = $model->getColumns($rows);
            $editableColumns = $model->convertToEditableCell($columns);
            $dataProvider = $model->getArrayDataProvider($rows);

            return $this->render('update', [
                'model' => $model,
                'dataProvider' => $dataProvider,
                'columns' => $editableColumns
            ]);
        }
    }
}
