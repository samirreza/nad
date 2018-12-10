<?php

namespace nad\extensions\thing\behaviors;

use yii\db\Query;
use yii\base\Behavior;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;

class ThingsQueryBehavior extends Behavior
{
    public $moduleId;
    public $modelShortClassName;

    const TYPE_MATERIAL = 0;
    const TYPE_EQUIPMENT = 1;
    const TYPE_EQUIPMENT_PART = 2;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        if (empty($this->modelShortClassName)) {
            throw new InvalidConfigException('modelShortClassName property must be set.');
        }
        parent::init();
    }

    public function hasAnyMaterials($materials)
    {
        return $this->hasAnyThings($materials, self::TYPE_MATERIAL);
    }

    public function hasAnyEquipments($equipments)
    {
        return $this->hasAnyThings($equipments, self::TYPE_EQUIPMENT);
    }

    public function hasAnyEquipmentParts($equipmentParts)
    {
        return $this->hasAnyThings($equipmentParts, self::TYPE_EQUIPMENT_PART);
    }

    private function hasAnyThings($things, $type)
    {
        if (!$things) {
            return $this->owner;
        }

        $modelIds = (new Query())
            ->select(['modelId'])
            ->distinct()
            ->from('nad_module_thing_relation')
            ->where([
                'moduleId' => $this->moduleId,
                'modelClassName' => $this->modelShortClassName,
                'thingTypeId' => $type
            ])
            ->andWhere(['in', 'thingId', ArrayHelper::getColumn($things, 'id')])
            ->column();

        $this->owner->andWhere(['in', 'id', $modelIds]);

        return $this->owner;
    }
}

