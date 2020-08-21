<?php

namespace nad\purchase\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use nad\purchase\models\FormsLookup;
use yii\base\InvalidConfigException;

class PreventDeleteBehavior extends Behavior
{
    public function init()
    {

    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_DELETE => 'canDelete'
        ];
    }

    public function canDelete($event)
    {
        if(!isset($this->owner->nextFormId)){
            return true;
        }
        $formLookupModel = FormsLookup::findOne($this->owner->nextFormId);
        $doesExist = $this->hasNextForm($formLookupModel);
        if ($doesExist) {
            $formName = $formLookupModel->title;
            $this->owner->addError(
                'id',
                "فرم مورد نظر به دلیل اتصال به فرم «{$formName}» غیرقابل حذف می باشد."
            );
            $event->isValid = false;
            $event->handled = true;
        }

        return true;
    }

    public function hasNextForm($formLookupModel){
        if(isset($formLookupModel)){
            $currentFormId = FormsLookup::find()->where(['tableName' => $this->owner->tableName()])->one()->id;

            $sql = "SELECT * FROM {$formLookupModel->tableName} WHERE prevFormId = :prevFormId AND prevRecordId = :prevRecordId";
            $row = Yii::$app->db->createCommand($sql)->bindValue(':prevFormId', $currentFormId)->bindValue(':prevRecordId', $this->owner->id)->queryOne();

            if(isset($row) && !empty($row))
                return true;
            else
                return false;;
        }

        throw new \Exception('Invalid Form!');
    }
}
