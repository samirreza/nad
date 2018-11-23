<?php

namespace nad\extensions\documentation\actions;

use Yii;
use yii\web\NotFoundHttpException;
use yii\base\InvalidConfigException;

class DocumentationAction extends \yii\base\Action
{
    public $modelClassName;

    public function init()
    {
        if (empty($this->modelClassName)) {
            throw new InvalidConfigException(
                'modelClassName property must be set.'
            );

        }
        parent::init();
    }

    public function run($id)
    {
        $model = $this->findModel($id);
        $documentation = $model->getDocumentation();
        if (!$documentation) {
            $documentation = $model->createDocumentation();
            Yii::$app->session->addFlash(
                'success',
                'مستندات با موفقیت ساخته شد.'
            );
        }
        return $this->controller->render('documentation', [
            'model' => $model,
            'documentation' => $documentation
        ]);
    }

    private function findModel($id)
    {
        $modelClass = $this->modelClassName;
        if ( ($model = $modelClass::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested model does not exist.');
        }
    }
}
