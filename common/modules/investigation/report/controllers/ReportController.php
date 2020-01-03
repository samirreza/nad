<?php

namespace nad\common\modules\investigation\report\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use nad\common\modules\investigation\report\models\Report;
use nad\common\modules\investigation\report\models\ReportArchived;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class ReportController extends BaseInvestigationController
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
                                return ['investigation' => Report::findOne([
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
                            'roles' => ['superuser', 'manager']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actions()
    {
        return [
            'generate-graph' => [
                'class' => 'nad\extensions\graphGenerator\actions\GenerateGraphAction',
                'modelClassName' => Report::class,
            ],
        ];
    }

    public function actionSetExpert($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Report::SCENARIO_SET_EXPERT;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'کارشناس با موفقیت در سیستم درج شد.'
            );
            return $this->redirect(['view', 'id' => $id]);
        }
        echo Json::encode([
            'content' => $this->renderAjax('set-expert', ['model' => $model])
        ]);
        exit;
    }

    public function actionCertificate($id)
    {
        $report = $this->findModel($id);
        $proposal = $report->proposal;
        $source = $proposal->source;

        $proposal->referenceClassName = $report->referenceClassName;
        $source->referenceClassName = $report->referenceClassName;

        return $this->render('certificate', [
            'source' => $source,
            'proposal' => $proposal,
            'report' => $report
        ]);
    }

    public function actionViewHistory($id)
    {
        $report = $this->findModel($id);
        $logs = $report->getLogsGroupedByUpdateTime(
            $includeFields = [
                'abstract',
                'description',
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
        $allComments = $report->comments;

        return $this->render('view_history', [
            'model' => $report,
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
        $report = $this->findArchivedModel($id);
        $proposal = $report->proposal;
        $source = $proposal->source;

        // TODO find a better way than manually setting this shit
        $proposal->referenceClassName = $report->referenceClassName;
        $source->referenceClassName = $report->referenceClassName;

        return $this->render('certificate_archived', [
            'source' => $source,
            'proposal' => $proposal,
            'report' => $report
        ]);
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
        if ($newStatus == Report::IS_SOURCE_ARCHIVED_YES) {
            $report = $this->findModel($id);
            $report->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از برنامه خارج و به داده گاه منشا اضافه شد.'
            );
            return $this->redirect(['archived-view', 'id' => $id]);
        }
        else{
            $archivedReport = $this->findArchivedModel($id);
            $archivedReport->changeArchive($newStatus);
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
        $model->userHolder = Report::USER_HOLDER_MANAGER;
        $model->deliverToManagerDate = time();
        $model->status = Report::STATUS_WAITING_FOR_CHECK_BY_MANAGER;
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
        $model->userHolder = Report::USER_HOLDER_EXPERT;
        $model->status = Report::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT;
        $model->save();
        Yii::$app->session->addFlash(
            'success',
            'آیتم مورد نظر با موفقیت به کارشناس ارسال شد.'
        );
        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionSetSessionDate($id)
    {
        $model = static::findModel($id);
        $model->scenario = Report::SCENARIO_SET_SESSION_DATE;
        $model->status = Report::STATUS_WAITING_FOR_SESSION_RESULT;
        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->addFlash(
                    'success',
                    'تاریخ جلسه توجیهی با موفقیت در سیستم درج شد.'
                );
                return $this->redirect(['view', 'id' => $id]);
            }
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/common/modules/investigation/common/views/set-session-date', [
                'model' => $model
            ])
        ]);
        exit;
    }

    public function actionWriteProceedings($id)
    {
        $model = static::findModel($id);
        $model->status = Report::STATUS_WAITING_FOR_NEXT_STATUS;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'نتیجه برگزاری جلسه با موفقیت در سیستم درج شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/common/modules/investigation/common/views/write-proceedings', [
                'model' => $model
            ])
        ]);
        exit;
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
