<?php
namespace modules\nad\equipment\modules\type\details\controllers;

use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use modules\nad\equipment\modules\type\models\Type;
use modules\nad\equipment\modules\type\details\models\Part;
use modules\nad\equipment\modules\type\details\models\PartSearch;

class PartController extends \core\controllers\AjaxAdminController
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['equipment.type'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function init()
    {
        $this->modelClass = Part::className();
        $this->searchClass = PartSearch::className();
        parent::init();
    }

    public function beforeAction($action)
    {
        if ($action->id == 'index') {
            $typeId = \Yii::$app->request->get('typeId');
            if (null == $typeId || null == Type::findOne($typeId)) {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }
        return parent::beforeAction($action);
    }
}
