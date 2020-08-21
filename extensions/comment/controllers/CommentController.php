<?php

namespace nad\extensions\comment\controllers;

use Yii;
use yii\helpers\Json;
use core\controllers\AjaxAdminController;
use nad\extensions\comment\models\Comment;

class CommentController extends AjaxAdminController
{
    public function init()
    {
        $this->modelClass = Comment::class;
        $this->searchClass = false;
        parent::init();
    }

    public function actionCreate()
    {
        $showReceiver = Yii::$app->request->get('showReceiver');
        if(!isset($showReceiver))
            $showReceiver = "F";

        $comment = new Comment([
            'moduleId' => Yii::$app->request->get('moduleId'),
            'modelClassName' => (new \ReflectionClass(Yii::$app->request->get('modelClassName')))
                ->getShortName(),
            'modelClassNameFull' => (new \ReflectionClass(Yii::$app->request->get('modelClassName')))
                ->getName(),
            'modelId' => Yii::$app->request->get('modelId')
        ]);
        $returnUrl = Yii::$app->request->get('returnUrl');
        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            if ($returnUrl) {
                Yii::$app->session->addFlash(
                    'success',
                    'نظر مورد نظر با موفقیت در سیستم درج شد.'
                );
                return $this->redirect($returnUrl);
            }
            echo Json::encode([
                'status' => 'success',
                'message' => 'نظر مورد نظر با موفقیت در سیستم درج شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax(
                '@nad/extensions/comment/views/_form', [
                    'comment' => $comment,
                    'showReceiver' => $showReceiver
                ]
            )
        ]);
        exit;
    }

    public function actionUpdate($id)
    {
        $showReceiver = Yii::$app->request->get('showReceiver');
        if(!isset($showReceiver))
            $showReceiver = "F";

        $comment = $this->findModel($id);
        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'نظر مورد نظر با موفقیت در سیستم بروزرسانی شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax(
                '@nad/extensions/comment/views/_form', [
                    'comment' => $comment,
                    'showReceiver' => $showReceiver
                ]
            )
        ]);
        exit;
    }
}
