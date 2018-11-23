<?php

namespace nad\extensions\documentation\controllers;

use Yii;
use yii\helpers\Json;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\ContentNegotiator;
use nad\extensions\documentation\models\File;
use nad\extensions\documentation\models\Documentation;

class DocumentationController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete-file' => ['post'],
                    'add-file' => ['post'],
                    'edit-file' => ['post'],
                    'delete' => ['post']
                ]
            ],
            [
                'class' => ContentNegotiator::class,
                'formats' => [
                    'application/json' => Response::FORMAT_JSON
                ]
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['operator']
                    ]
                ]
            ]
        ];
    }

    public function actionAddFile($documentationId)
    {
        $file = new File([
            'documentationId' => $documentationId
        ]);
        if ($file->load(Yii::$app->request->post()) && $file->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'فایل با موفقیت به مستندات افزوده شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'status' => 'renderEmptyForm',
            'content' => $this->renderAjax(
                '@nad/extensions/documentation/views/_form',
                ['file' => $file]
            )
        ]);
        exit;
    }

    public function actionEditFile($id)
    {
        $file = File::findOne($id);
        if ($file->load(Yii::$app->request->post()) && $file->save()) {
            echo Json::encode([
                'status' => 'success',
                'message' => 'ویرایش اطلاعات فایل با موفقیت انجام شد.'
            ]);
            exit;
        }
        echo Json::encode([
            'status' => 'renderEmptyForm',
            'content' => $this->renderAjax(
                '@nad/extensions/documentation/views/_form',
                ['file' => $file]
            )
        ]);
        exit;
    }

    public function actionDeleteFile($id)
    {
        File::findOne($id)->delete();
        echo Json::encode([
            'status' => 'success',
            'message' => 'فایل با موفقیت حذف شد.'
        ]);
    }

    public function actionDelete($id)
    {
        $returnUrl = urldecode(Yii::$app->request->get('returnUrl'));
        $modelId = (int) urldecode(Yii::$app->request->get('modelId'));
        $modelClassName = Documentation::findOne($id)->modelClassName;
        $modelClassName::findOne($modelId)->deleteDocumentation();
        Yii::$app->session->addFlash(
            'success',
            'مستندات با موفقیت حذف شد.'
        );
        return $this->redirect($returnUrl);
    }
}
