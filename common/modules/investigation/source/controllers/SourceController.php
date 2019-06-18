<?php

namespace nad\common\modules\investigation\source\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class SourceController extends BaseInvestigationController
{
    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => [
                                'update',
                                'delete',
                                'deliver-to-manager'
                            ],
                            'roles' => ['investigation.manageOwnInvestigation'],
                            'roleParams' => function() {
                                return ['investigation' => Source::findOne([
                                    'id' => Yii::$app->request->get('id')]
                                )];
                            }
                        ],
                        [
                            'allow' => true,
                            'actions' => ['accepted-index'],
                            'roles' => ['manager']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionAcceptedIndex()
    {
        $searchModel = new $this->searchClass;
        $params = Yii::$app->request->queryParams;
        $params[$searchModel->formName()]['status'] = Source::STATUS_ACCEPTED;
        $dataProvider = $searchModel->search($params);

        return $this->render('accepted-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionSetExperts($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Source::SCENARIO_SET_EXPERT;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'کارشناسان با موفقیت در سیستم درج شدند.'
            );
            return $this->redirect(['view', 'id' => $id]);
        }
        echo Json::encode([
            'content' => $this->renderAjax('set-experts', ['model' => $model])
        ]);
        exit;
    }

    public function actionCertificate($id)
    {
        $source = $this->findModel($id);
        return $this->render('certificate', ['source' => $source]);
    }
}
