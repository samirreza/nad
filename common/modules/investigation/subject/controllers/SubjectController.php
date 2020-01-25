<?php

namespace nad\common\modules\investigation\subject\controllers;

use Yii;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use nad\common\modules\investigation\subject\models\Subject;
use nad\common\modules\investigation\subject\models\SubjectArchived;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class SubjectController extends BaseInvestigationController
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
                                'deliver-to-manager',
                                'change-status'
                            ],
                            'roles' => ['investigation.manageOwnInvestigation'],
                            'roleParams' => function() {
                                return [
                                    'investigation' => Subject::findOne(['id' => Yii::$app->request->get('id')]),
                                    'allowSecondExpert' => true
                                ];
                            }
                        ],
                        [
                            'allow' => true,
                            'actions' => [
                                'archived-certificate',
                                'archived-view',
                                'archived-index',
                                'change-archive',
                                'deliver-to-expert',
                                'change-status'
                            ],
                            'roles' => ['superuser']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionSetExpert($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Subject::SCENARIO_SET_EXPERT;
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
        $subject = $this->findModel($id);
        return $this->render('certificate', ['subject' => $subject]);
    }

    public function actionViewHistory($id)
    {
        $subject = $this->findModel($id);
        $logs = $subject->getLogsGroupedByUpdateTime(
            $includeFields = [
                'text',
                // 'proceedings',
                'sessionDate'
                // 'title',
                // 'englishTitle',
            ],
            $excludeFields = [],
            $onlyChangedFields = false,
            $sortType = 'DESC'
        );

        $logCounter = count($logs);
        $allComments = $subject->comments;

        return $this->render('view_history', [
            'model' => $subject,
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
        $subject = $this->findArchivedModel($id);
        return $this->render('certificate_archived', ['subject' => $subject]);
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
        if ($newStatus == Subject::IS_SOURCE_ARCHIVED_YES) {
            $subject = $this->findModel($id);
            $subject->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از برنامه خارج و به داده گاه موضوع اضافه شد.'
            );
            return $this->redirect(['archived-view', 'id' => $id]);
        }
        else{
            $archivedSubject = $this->findArchivedModel($id);
            $archivedSubject->changeArchive($newStatus);
            Yii::$app->session->addFlash(
                'success',
                'آیتم مورد نظر از داده گاه خارج و به برنامه موضوع اضافه شد.'
            );
            return $this->redirect(['view', 'id' => $id]);
        }
    }

    public function actionDeliverToManager($id)
    {
        $model = static::findModel($id);
        $model->userHolder = Subject::USER_HOLDER_MANAGER;
        $model->deliverToManagerDate = time();
        $model->status = Subject::STATUS_WAITING_FOR_CHECK_BY_MANAGER;
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
        $model->userHolder = Subject::USER_HOLDER_EXPERT;
        $model->status = Subject::STATUS_WAITING_FOR_CORRECTION_BY_EXPERT;
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
        $model->scenario = Subject::SCENARIO_SET_SESSION_DATE;
        $model->status = Subject::STATUS_WAITING_FOR_NEXT_STATUS;
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
