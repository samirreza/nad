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
        $comment = new Comment([
            'moduleId' => Yii::$app->request->get('moduleId'),
            'modelClassName' => (new \ReflectionClass(Yii::$app->request->get('modelClassName')))
                ->getShortName(),
            'modelId' => Yii::$app->request->get('modelId')
        ]);
        if ($comment->load(Yii::$app->request->post()) && $comment->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'نظر مورد نظر با موفقیت در سیستم درج شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'content' => $this->renderAjax(
                '@nad/extensions/comment/views/_form', [
                    'comment' => $comment
                ]
            )
        ]);
        exit;
    }
}
