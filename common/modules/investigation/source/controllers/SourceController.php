<?php

namespace nad\common\modules\investigation\source\controllers;

use Yii;
use yii\helpers\Json;
use nad\common\modules\investigation\source\models\Source;
use nad\common\modules\investigation\common\controllers\BaseInvestigationController;

class SourceController extends BaseInvestigationController
{
    public function actionSetExperts($id)
    {
        $model = $this->findModel($id);
        $model->scenario = Source::SCENARIO_SET_EXPERT;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->addFlash(
                'success',
                'کارشناسان با موفقیت در سیستم درج شدند.'
            );
            return $this->redirect(['view', 'id' => $id]);
        }
        echo Json::encode([
            'content' => $this->renderAjax('@nad/common/modules/investigation/source/views/manage/set-experts', ['model' => $model])
        ]);
        exit;
    }
}
