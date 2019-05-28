<?php

namespace nad\process\ird\pool\investigation\proposal\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use nad\process\ird\pool\investigation\proposal\models\Proposal;
use nad\process\ird\pool\investigation\proposal\models\ProposalSearch;
use nad\common\modules\investigation\proposal\controllers\ProposalController;

class ManageController extends ProposalController
{
    public function init()
    {
        $this->modelClass = Proposal::class;
        $this->searchClass = ProposalSearch::class;
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
                                'index',
                                'view',
                                'create'
                            ],
                            'roles' => ['pool.investigation']
                        ]
                    ]
                ]
            ]
        );
    }

    public function actionCreate()
    {
        $model = new Proposal([
            'sourceId' => Yii::$app->request->get('sourceId')
        ]);
        $model->loadDefaultValues();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'داده مورد نظر با موفقیت در سیستم درج شد.'
            );
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', ['model' => $model]);
        }
    }
}
