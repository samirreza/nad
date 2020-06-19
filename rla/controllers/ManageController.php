<?php

namespace nad\rla\controllers;

use Yii;
use IntlDateFormatter;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use nad\office\modules\expert\models\Expert;
use nad\office\modules\expert\models\ExpertSearch;
use nad\office\modules\expert\models\ExpertForm;
use nad\rla\models\RowLevelAccess;
use nad\rla\models\RowLevelAccessPreview;
use modules\user\backend\models\User;
use yii\data\SqlDataProvider;

class ManageController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'grant-revoke-access' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'get-access-modal',
                            'grant-revoke-access',
                            'grant-revoke-preview',
                            'get-users-by-item-type'
                        ],
                        'roles' => ['superuser']
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'preview',
                            'preview-index',
                        ],
                        'roles' => ['@']
                    ]
                ]
            ]
        ];
    }

    public function actionIndex($searchModel = 'nad\common\modules\investigation\source\models\SourceSearch')
    {
        $myClass = new \ReflectionClass($searchModel);
        $instanceModel = $myClass->newInstance();
        $dataProvider = $instanceModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 100;
        $itemTypes = RowLevelAccess::getCommonItemTypes();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'instanceModel' => $instanceModel,
            'dataProvider' => $dataProvider,
            'itemTypes' => $itemTypes
        ]);
    }

    public function actionGetAccessModal($ids){
        $ids = Json::decode($ids);
        if(!is_array($ids) || empty($ids)){
            throw new \yii\web\BadRequestHttpException();
        }

        $modelTemplate = new RowLevelAccess();
        $modelTemplate->seqAccessIds = $ids;

        $models = [];
        if(count($ids) == 1){
            $models = RowLevelAccess::find()->Where(['in', 'seq_access_id', $modelTemplate->seqAccessIds])->asArray()->all();
            // $subQuery = RowLevelAccess::find()->select(['user_id'])->Where(['in', 'seq_access_id', $model->seqAccessIds]);
            // $users = User::find()->Where(['in', 'id', $subQuery])->asArray()->all();
        }else{
            $models = [];
        }

        return $this->renderAjax('_access_modal', [
            'modelTemplate' => $modelTemplate,
            'models' => $models,
            'experts' => Expert::find()->all()
            ]);
    }

    public function actionGrantRevokeAccess(){
        $model = new RowLevelAccess();
        $model->load(Yii::$app->request->post());

        $transaction = Yii::$app->db->beginTransaction();
        try {
            Yii::$app->db->createCommand()->delete(RowLevelAccess::tableName(), ['in', 'seq_access_id', $model->seqAccessIds])->execute();

            if (isset($model->userIds) && is_array($model->userIds) && !empty($model->userIds)) {
                $rows = [];
                foreach ($model->seqAccessIds as $seqId) {
                    foreach ($model->userIds as $userId) {
                        $formatter = new IntlDateFormatter(
                            'en_US@calendar=persian',
                            IntlDateFormatter::SHORT,
                            IntlDateFormatter::NONE,
                            'Asia/Tehran',
                            IntlDateFormatter::TRADITIONAL,
                            "yyyy/MM/dd"
                        ); // lol
                        $expireDate = isset($model->expireDates[$userId])?$formatter->parse($model->expireDates[$userId]):time();

                        $tmp = [
                        $seqId,
                        $userId,
                        $model->accessTypes[$userId],
                        $expireDate
                    ];

                        $rows[] = $tmp;
                    }
                }

                Yii::$app->db->createCommand()->batchInsert(
                    RowLevelAccess::tableName(),
                    [
                    'seq_access_id',
                    'user_id',
                    'access_type',
                    'expire_date'
                ],
                    $rows
                )->execute();
            }
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (\Throwable $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    public function actionPreviewIndex(){
        $allowedPreviews = RowLevelAccessPreview::find()->where(['user_id' => Yii::$app->user->id])->all();
        $allowedItemTypes = RowLevelAccess::getAllowedItemTypesForTree($allowedPreviews);

        if(empty($allowedItemTypes)){
            throw new \yii\web\HttpException(403, 'شما به هیچ داده گاهی، دسترسی پیش نمایش ندارید! لطفا با مدیر سایت تماس بگیرید.');
        }

        return $this->render('preview_index', [
            'allowedItemTypes' => $allowedItemTypes
        ]);
    }

    public function actionPreview($searchModel){
        $allowedPreviews = RowLevelAccessPreview::find()->where([
            'user_id' => Yii::$app->user->id,
            'item_type' => $searchModel
            ])->all();

        $allowedItemTypes = RowLevelAccess::getAllowedItemTypesForTree($allowedPreviews);

        $myClass = new \ReflectionClass($searchModel);
        $instanceModel = $myClass->newInstance();
        $instanceModel->load(Yii::$app->request->get());

        $countQuery = (new \yii\db\Query())
            ->select('count(*)')
            ->from($instanceModel::tableName())
            ->where(['consumer' => $searchModel::CONSUMER_CODE])
            ->andFilterWhere(['like', 'title', $instanceModel->title])
            ->andFilterWhere(['like', 'uniqueCode', $instanceModel->uniqueCode]);

        $sqlQuery = (new \yii\db\Query())
            ->select(['uniqueCode', 'title', 'createdAt', 'updatedAt'])
            ->from($instanceModel::tableName())
            ->where(['consumer' => $searchModel::CONSUMER_CODE])
            ->andFilterWhere(['like', 'title', $instanceModel->title])
            ->andFilterWhere(['like', 'uniqueCode', $instanceModel->uniqueCode]);

        if($allowedPreviews == null || empty($allowedPreviews)){
            $countQuery->andWhere('1=0');
            $sqlQuery->andWhere('1=0');
        }
        $count  = $countQuery->createCommand()->queryScalar();
        $rawSql = $sqlQuery->createCommand()->getRawSql();

        $dataProvider = new SqlDataProvider([
            'sql' => $rawSql,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => [
                    'title',
                    'uniqueCode',
                    'createdAt',
                    'updatedAt'
                ],
            ],
        ]);

        return $this->render('preview', [
            'searchModel' => $searchModel,
            'instanceModel' => $instanceModel,
            'dataProvider' => $dataProvider,
            'allowedItemTypes' => $allowedItemTypes
        ]);
    }

    public function actionGrantRevokePreview(){
        $itemTypes = RowLevelAccess::getItemTypes();
        $modelTemplate = new RowLevelAccessPreview();

        if($modelTemplate->load(Yii::$app->request->post())){
            $modelTemplate->itemTypes = Json::decode($modelTemplate->itemTypes);

            $transaction = Yii::$app->db->beginTransaction();
            try {
                Yii::$app->db->createCommand()->delete(
                    RowLevelAccessPreview::tableName(),
                    ['in', 'item_type', $modelTemplate->itemTypes]
                )->execute();

                $rows = [];
                foreach ($modelTemplate->itemTypes as $itemType) {
                    if(isset($modelTemplate->userIds) && is_array($modelTemplate->userIds)){
                        $itemUserIds = $modelTemplate->userIds;
                        foreach ($itemUserIds as $userId) {
                            $tmp = [
                                $itemType,
                                $userId,
                            ];

                            $rows[] = $tmp;
                        }
                    }
                }

                Yii::$app->db->createCommand()->batchInsert(RowLevelAccessPreview::tableName(),
                    [
                        'item_type',
                        'user_id',
                    ],
                    $rows
                )->execute();

                $transaction->commit();

                return  'عملیات مورد نظر با موفقیت در سیستم ثبت شد.';

            } catch (\Exception $e) {
                $transaction->rollBack();
                throw $e;
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }else if($modelTemplate->hasErrors()){
            return $modelTemplate->getFirstErrors();
        }

        return $this->render('grant_revoke_preview', [
            'modelTemplate' => $modelTemplate,
            'itemTypes' => $itemTypes,
            'experts' => Expert::find()->all()
        ]);
    }

    public function actionGetUsersByItemType($itemTypes){
        $decodedItemTypes = Json::decode($itemTypes);
        $users = ArrayHelper::getColumn(
            RowLevelAccessPreview::find()->where(['in', 'item_type', $decodedItemTypes])->Select('user_id')->distinct()->all(),
            'user_id'
        );

        $finalUsers = [];
        foreach ($users as $user) {
            $finalUsers[] = strval($user);
        }

        return Json::encode($finalUsers);
    }
}
