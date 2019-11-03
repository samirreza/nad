<?php

namespace nad\common\modules\investigation\instruction\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use nad\common\modules\investigation\instruction\models\Instruction;
use nad\common\modules\investigation\instruction\models\InstructionArchived;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class InstructionController extends BaseInvestigationController
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
                                return ['investigation' => Instruction::findOne([
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
                'modelClassName' => Instruction::class,
            ],
        ];
    }

    public function actionSetExpert($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Instruction::SCENARIO_SET_EXPERT;
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
        $instruction = $this->findModel($id);
        $method = $instruction->method;
        $proposal = $instruction->proposal;
        $report = $instruction->report;
        $source = $proposal->source;

        $method->referenceClassName = $instruction->referenceClassName;
        $report->referenceClassName = $instruction->referenceClassName;
        $proposal->referenceClassName = $instruction->referenceClassName;
        $source->referenceClassName = $instruction->referenceClassName;

        return $this->render('certificate', [
            'method' => $method,
            'instruction' => $instruction,
            'report' => $report,
            'proposal' => $proposal,
            'source' => $source
        ]);
    }

    public function actionViewHistory($id)
    {
        $instruction = $this->findModel($id);
        $logs = $instruction->getLogsGroupedByUpdateTime(
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
        $allComments = $instruction->comments;

        return $this->render('view_history', [
            'model' => $instruction,
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
        $instruction = $this->findArchivedModel($id);
        $method = $instruction->method;
        $proposal = $instruction->proposal;
        $report = $instruction->report;
        $source = $proposal->source;

        $method->referenceClassName = $instruction->referenceClassName;
        $report->referenceClassName = $instruction->referenceClassName;
        $proposal->referenceClassName = $instruction->referenceClassName;
        $source->referenceClassName = $instruction->referenceClassName;

        return $this->render('certificate_archived', [
            'method' => $method,
            'report' => $report,
            'proposal' => $proposal,
            'source' => $source,
            'instruction' => $instruction,
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
        if ($newStatus == Instruction::IS_SOURCE_ARCHIVED_YES) {
            $instruction = $this->findModel($id);
            $instruction->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از برنامه خارج و به داده گاه دستورالعمل اضافه شد.'
            );
            return $this->redirect(['archived-view', 'id' => $id]);
        }
        else{
            $archivedInstruction = $this->findArchivedModel($id);
            $archivedInstruction->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از داده گاه خارج و به برنامه دستورالعمل اضافه شد.'
            );
            return $this->redirect(['view', 'id' => $id]);
        }
    }

    public function actionDeliverToManager($id)
    {
        $model = static::findModel($id);
        $model->userHolder = Instruction::USER_HOLDER_MANAGER;
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
        $model->userHolder = Instruction::USER_HOLDER_EXPERT;
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
