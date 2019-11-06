<?php

namespace nad\common\modules\investigation\method\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use nad\common\modules\investigation\method\models\Method;
use nad\common\modules\investigation\method\models\MethodArchived;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class MethodController extends BaseInvestigationController
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
                                return ['investigation' => Method::findOne([
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
                'modelClassName' => Method::class,
            ],
        ];
    }

    public function actionSetExpert($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Method::SCENARIO_SET_EXPERT;
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
        $method = $this->findModel($id);
        $source = $method->source;
        $proposal = $method->proposal;
        $report = $method->report;

        if(isset($source))
            $source->referenceClassName = $method->referenceClassName;
        if(isset($proposal))
            $proposal->referenceClassName = $method->referenceClassName;
        if(isset($report))
            $report->referenceClassName = $method->referenceClassName;

        return $this->render('certificate', [
            'source' => $source,
            'proposal' => $proposal,
            'report' => $report,
            'method' => $method,
        ]);
    }

    public function actionViewHistory($id)
    {
        $method = $this->findModel($id);
        $logs = $method->getLogsGroupedByUpdateTime(
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
        $allComments = $method->comments;

        return $this->render('view_history', [
            'model' => $method,
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
        $method = $this->findArchivedModel($id);
        $report = $method->report;
        $proposal = $method->proposal;

        $source = null;
        if(isset($proposal))
            $source = $proposal->source;
        elseif(isset($report))
            $source = $report->proposal->source;

        if(isset($source))
            $source->referenceClassName = $method->referenceClassName;
        if(isset($proposal))
            $proposal->referenceClassName = $method->referenceClassName;
        if(isset($report))
            $report->referenceClassName = $method->referenceClassName;

        return $this->render('certificate_archived', [
            'source' => $source,
            'proposal' => $proposal,
            'report' => $report,
            'method' => $method,
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
        if ($newStatus == Method::IS_SOURCE_ARCHIVED_YES) {
            $method = $this->findModel($id);
            $method->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از برنامه خارج و به داده گاه روش اضافه شد.'
            );
            return $this->redirect(['archived-view', 'id' => $id]);
        }
        else{
            $archivedMethod = $this->findArchivedModel($id);
            $archivedMethod->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از داده گاه خارج و به برنامه روش اضافه شد.'
            );
            return $this->redirect(['view', 'id' => $id]);
        }
    }

    public function actionDeliverToManager($id)
    {
        $model = static::findModel($id);
        $model->userHolder = Method::USER_HOLDER_MANAGER;
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
        $model->userHolder = Method::USER_HOLDER_EXPERT;
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
