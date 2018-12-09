<?php

namespace nad\extensions\thing\behaviors;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\base\InvalidConfigException;

class ThingsDeleteBehavior extends Behavior
{
    public $thingType;

    const TYPE_MATERIAL = 0;
    const TYPE_EQUIPMENT = 1;
    const TYPE_EQUIPMENT_PART = 2;

    public function init()
    {
        if (!isset($this->thingType)) {
            throw new InvalidConfigException('thingType property must be set.');
        }
        parent::init();
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }

    public function afterDelete()
    {
        Yii::$app->db->createCommand()->delete('nad_module_thing_relation', [
            'thingId' => $this->owner->getPrimaryKey(),
            'thingTypeId' => $this->thingType
        ])->execute();
    }
}
