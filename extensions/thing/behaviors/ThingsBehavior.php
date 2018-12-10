<?php

namespace nad\extensions\thing\behaviors;

use Yii;
use yii\db\Query;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use modules\nad\material\modules\type\models\Type as Material;
use modules\nad\equipment\modules\type\models\Type as Equipment;
use modules\nad\equipment\modules\type\details\models\Part as EquipmentPart;

class ThingsBehavior extends Behavior
{
    private $materials;
    private $equipments;
    private $equipmentParts;

    public $moduleId;

    const TYPE_MATERIAL = 0;
    const TYPE_EQUIPMENT = 1;
    const TYPE_EQUIPMENT_PART = 2;

    public function init()
    {
        if (empty($this->moduleId)) {
            throw new InvalidConfigException('moduleId property must be set.');
        }
        parent::init();
    }

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'attachThings',
            ActiveRecord::EVENT_AFTER_UPDATE => 'attachThings',
            ActiveRecord::EVENT_AFTER_DELETE => 'deleteThings'
        ];
    }

    public function setMaterials($materials)
    {
        $this->materials = empty($materials) ? [] : $materials;
    }

    public function setEquipments($equipments)
    {
        $this->equipments = empty($equipments) ? [] : $equipments;
    }

    public function setEquipmentParts($equipmentParts)
    {
        $this->equipmentParts = empty($equipmentParts) ? [] : $equipmentParts;
    }

    public function attachThings()
    {
        $this->attachThing('materials', self::TYPE_MATERIAL);
        $this->attachThing('equipments', self::TYPE_EQUIPMENT);
        $this->attachThing('equipmentParts', self::TYPE_EQUIPMENT_PART);
    }

    public function attachThing($property, $type)
    {
        if ($this->$property === null) {
            return;
        }

        if (!$this->owner->isNewRecord) {
            $this->deleteThing($type);
        }

        foreach ($this->$property as $prop) {
            $rows[] = [
                $prop,
                $type,
                $this->owner->getPrimaryKey(),
                (new \ReflectionClass($this->owner))
                    ->getShortName(),
                $this->moduleId
            ];
        }

        if (!empty($rows)) {
            Yii::$app->db->createCommand()->batchInsert(
                'nad_module_thing_relation',
                ['thingId', 'thingTypeId', 'modelId', 'modelClassName', 'moduleId'],
                $rows
            )->execute();
        }
    }

    public function deleteThing($type)
    {
        Yii::$app->db->createCommand()->delete('nad_module_thing_relation', [
            'modelId' => $this->owner->getPrimaryKey(),
            'modelClassName' => (new \ReflectionClass($this->owner))
                ->getShortName(),
            'moduleId' => $this->moduleId,
            'thingTypeId' => $type
        ])->execute();
    }

    public function deleteThings()
    {
        Yii::$app->db->createCommand()->delete('nad_module_thing_relation', [
            'modelId' => $this->owner->getPrimaryKey(),
            'modelClassName' => (new \ReflectionClass($this->owner))
                ->getShortName(),
            'moduleId' => $this->moduleId
        ])->execute();
    }

    public function getMaterials()
    {
        return Material::find()
            ->andWhere([
                'in',
                'id',
                $this->getThingIdsAsArray('materials', self::TYPE_MATERIAL)
            ])
            ->all();
    }

    public function getMaterialsAsString()
    {
        return implode(', ', ArrayHelper::getColumn($this->getMaterials(), 'title'));
    }

    public function getEquipments()
    {
        return Equipment::find()
            ->andWhere([
                'in',
                'id',
                $this->getThingIdsAsArray('equipments', self::TYPE_EQUIPMENT)
            ])
            ->all();
    }

    public function getEquipmentsAsString()
    {
        return implode(', ', ArrayHelper::getColumn($this->getEquipments(), 'title'));
    }

    public function getEquipmentParts()
    {
        return EquipmentPart::find()
            ->andWhere([
                'in',
                'id',
                $this->getThingIdsAsArray('equipmentParts', self::TYPE_EQUIPMENT_PART)
            ])
            ->all();
    }

    public function getEquipmentPartsAsString()
    {
        return implode(', ', ArrayHelper::getColumn($this->getEquipmentParts(), 'title'));
    }

    private function getThingIdsAsArray($property, $type)
    {
        if (!$this->owner->isNewRecord && $this->$property === null) {
            $this->$property = (new Query())
                ->select(['thingId'])
                ->from('nad_module_thing_relation')
                ->where([
                    'thingTypeId' => $type,
                    'modelId' => $this->owner->getPrimaryKey(),
                    'modelClassName' => (new \ReflectionClass($this->owner))
                        ->getShortName(),
                    'moduleId' => $this->moduleId
                ])
                ->column();
        }

        return $this->$property == null ? [] : $this->$property;
    }
}
