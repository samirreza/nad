<?php

namespace nad\purchase\models;

use yii\helpers\Html;
use nad\purchase\models\FormsLookup;
use nad\office\modules\expert\models\Expert;

use Yii;

/**
 * This is the model class for table "nad_purchase_forms_lookup".
 *
 * @property int $id
 * @property string $tableName
 * @property string $title
 * @property string $baseUrl
 */
class FormsLookup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nad_purchase_forms_lookup';
    }

    public static function getNextFormAsLink($nextFormId, $purchaseGlobalId, $prevExpertId, $tableName){
        $prevFormId = FormsLookup::find()->where(['tableName' => $tableName])->one()->id;
        $model = FormsLookup::findOne($nextFormId);

        if(isset($model)){
            $sql = "SELECT * FROM {$model->tableName} WHERE purchaseGlobalId = :purchaseGlobalId";
            $row = Yii::$app->db->createCommand($sql)->bindValue(':purchaseGlobalId', $purchaseGlobalId)->queryOne();

            if(isset($row) && !empty($row))
                return
                    '<u>'
                    . Html::a(
                        $model->title,
                        [
                            $model->baseUrl . '/view',
                            'id' => $row['id']
                        ]
                    )
                    . '</u>'
                    .  '&nbsp;&nbsp;<i class="fa fa-check" style="color:green" title="پر شده"></i>';
            else
                return
                    '<u>'
                    . Html::a(
                        $model->title,
                        [
                            $model->baseUrl . '/create',
                            'prevFormId' => $prevFormId,
                            'prevExpertId' => $prevExpertId,
                            'purchaseGlobalId' => $purchaseGlobalId

                        ]
                    )
                    . '</u>'
                    . '&nbsp;&nbsp;<i class="fa fa-times" style="color:red" title="پر نشده"></i>';
        }

        return null;
    }

    public static function getPrevFormAsLink($prevFormId, $purchaseGlobalId, $prevExpertId){
        $model = FormsLookup::findOne($prevFormId);

        if(isset($model)){
            $columnName = '';
            if($model->tableName == 'nad_purchase_form1')
                $columnName = 'id';
            else
                $columnName = 'purchaseGlobalId';

            $sql = "SELECT * FROM {$model->tableName} WHERE {$columnName} = :purchaseGlobalId";
            $row = Yii::$app->db->createCommand($sql)->bindValue(':purchaseGlobalId', $purchaseGlobalId)->queryOne();

            if(isset($row) && !empty($row))
                return
                    '<u>'
                    . Html::a(
                        $model->title,
                        [
                            $model->baseUrl . '/view',
                            'id' => $row['id']
                        ]
                    )
                    . '</u>';
        }

        return null;
    }

    public static function getPrevExpertName($prevModel){
        try {
            if (isset($prevModel->prevExpertId)) {
                return Expert::findOne($prevModel->prevExpertId)->user->fullName;
            }

            return null;
        }catch(\yii\base\ErrorException $ex){
            return 'مدیر';
        }
    }

    public static function getNextExpertName($nextModel){
        if(isset($nextModel->nextExpertId))
            return Expert::findOne($nextModel->nextExpertId)->user->fullName;

        return null;
    }
}
