<?php

namespace nad\common\modules\investigation\source\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\source\models\SourceArchived;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class SourceController extends BaseInvestigationController
{
    public $archivedClassName;
    public $archivedSearchClassName;

    public function init()
    {
        if (!isset($this->archivedClassName) || !isset($this->archivedSearchClassName)) {
            throw new InvalidConfigException("
                \$archivedClassName and archivedSearchClassName properties must be set.
            ");
        }
    }

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
                            'actions' => [
                                'archived-certificate',
                                'archived-view',
                                'archived-index',
                                'change-archive',
                                'deliver-to-expert'
                            ],
                            'roles' => ['superuser']
                        ]
                    ]
                ]
            ]
        );
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

    public function actionViewHistory($id)
    {
        $source = $this->findModel($id);
        $logs = $source->getLogsGroupedByUpdateTime(
            $includeFields = [
                'reasonForGenesis',
                'necessity',
                'proceedings',
                'sessionDate'
                // 'title',
                // 'englishTitle',
                // 'referencesAsString'
            ],
            $excludeFields = [],
            $onlyChangedFields = false,
            $sortType = 'DESC'
        );

        $logCounter = count($logs);
        $allComments = $source->comments;

        return $this->render('view_history', [
            'model' => $source,
            'logs' => $logs,
            'logCounter' => $logCounter,
            'allComments' =>$allComments
            ]);
    }

    public function actionIndexHistory()
    {
        $searchModel = new $this->searchClass;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_history', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArchivedCertificate($id)
    {
        $source = $this->findArchivedModel($id);
        return $this->render('certificate_archived', ['source' => $source]);
    }

    public function actionArchivedView($id){
        return $this->render('view_archived', [
            'model' => $this->findArchivedModel($id),
        ]);
    }

    public function actionArchivedIndex(){
        $searchModel = new $this->archivedSearchClassName;
        $searchModel->isArchived = $searchModel::IS_SOURCE_ARCHIVED_YES;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index_archived', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChangeArchive($id, $newStatus)
    {
        if ($newStatus == Source::IS_SOURCE_ARCHIVED_YES) {
            $source = $this->findModel($id);
            $source->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از برنامه خارج و به داده گاه منشا اضافه شد.'
            );
            return $this->redirect(['archived-view', 'id' => $id]);
        }
        else{
            $archivedSource = $this->findArchivedModel($id);
            $archivedSource->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از داده گاه خارج و به برنامه منشا اضافه شد.'
            );
            return $this->redirect(['view', 'id' => $id]);
        }
    }

    public function actionDeliverToManager($id)
    {
        $model = static::findModel($id);
        $model->userHolder = Source::USER_HOLDER_MANAGER;
        $model->deliverToManagerDate = time();
        $model->save();
        Yii::$app->session->addFlash(
            'success',
            'آیتم مورد نظر با موفقیت به مدیر ارسال شد.'
        );
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionDeliverToExpert($id)
    {
        $model = static::findModel($id);
        $model->userHolder = Source::USER_HOLDER_EXPERT;
        $model->save();
        Yii::$app->session->addFlash(
            'success',
            'آیتم مورد نظر با موفقیت به کارشناس ارسال شد.'
        );
        return $this->redirect(['view', 'id' => $id]);
    }

    protected function findArchivedModel($id)
    {
        $modelClass = $this->archivedClassName;
        if (($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
