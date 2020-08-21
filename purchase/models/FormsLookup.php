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

    public static function find()
    {
        return parent::find()->andWhere(['isActive' => 'T']);
    }

    public static function getNextFormAsLink($nextFormId, $prevRecordId, $prevExpertId, $purchaseGlobalId, $tableName){
        $prevFormId = FormsLookup::find()->where(['tableName' => $tableName])->one()->id;
        $model = FormsLookup::findOne($nextFormId);

        if(isset($model)){
            $sql = "SELECT * FROM {$model->tableName} WHERE prevFormId = :prevFormId AND prevRecordId = :prevRecordId";
            $row = Yii::$app->db->createCommand($sql)->bindValue(':prevFormId', $prevFormId)->bindValue(':prevRecordId', $prevRecordId)->queryOne();

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
                            'prevRecordId' => $prevRecordId,
                            'prevExpertId' => $prevExpertId,
                            'purchaseGlobalId' => $purchaseGlobalId

                        ]
                    )
                    . '</u>'
                    . '&nbsp;&nbsp;<i class="fa fa-times" style="color:red" title="پر نشده"></i>';
        }

        return null;
    }

    public static function getPrevFormAsLink($prevFormId, $prevRecordId){
        $model = FormsLookup::findOne($prevFormId);

        if(isset($model)){
            $sql = "SELECT * FROM {$model->tableName} WHERE id = :prevRecordId";
            $row = Yii::$app->db->createCommand($sql)->bindValue(':prevRecordId', $prevRecordId)->queryOne();

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

    public static function getLastFormAsLink($nextFormId, $prevRecordId, $prevExpertId, $purchaseGlobalId, $tableName){
        while(isset($nextFormId)){
            $prevFormId = FormsLookup::find()->where(['tableName' => $tableName])->one()->id;
            $formLookupModel = FormsLookup::findOne($nextFormId);

            $sql = "SELECT * FROM {$formLookupModel->tableName} WHERE prevFormId = :prevFormId AND prevRecordId = :prevRecordId";
            $nextRecord = Yii::$app->db->createCommand($sql)->bindValue(':prevFormId', $prevFormId)->bindValue(':prevRecordId', $prevRecordId)->queryOne();

            if(isset($nextRecord) && !empty($nextRecord)){
                $nextFormId = $nextRecord['nextFormId'];
                if(!isset($nextFormId)){
                    return
                        '<u>'
                        . Html::a(
                            $formLookupModel->title,
                            [
                                $formLookupModel->baseUrl . '/view',
                                'id' => $nextRecord['id']
                            ]
                        )
                        . '</u>'
                        .  '&nbsp;&nbsp;<i class="fa fa-check" style="color:green" title="پر شده"></i>';
                }else{
                    $prevRecordId = $nextRecord['id'];
                    $prevExpertId = $nextRecord['nextExpertId'];
                    $tableName = $formLookupModel->tableName;
                    continue;
                }
            }

            return
                '<u>'
                . Html::a(
                    $formLookupModel->title,
                    [
                        $formLookupModel->baseUrl . '/create',
                        'prevFormId' => $prevFormId,
                        'prevRecordId' => $prevRecordId,
                        'prevExpertId' => $prevExpertId,
                        'purchaseGlobalId' => $purchaseGlobalId

                    ]
                )
                . '</u>'
                . '&nbsp;&nbsp;<i class="fa fa-times" style="color:red" title="پر نشده"></i>';
        }

        return null;
    }

    public static function getLastExpertName($nextModel){

        return 'TBD';
    }
}
