<?php
namespace nad\common\code;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class CodableCategoryBehavior extends \yii\base\Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => function ($event) {
                $this->owner->code = strtoupper($this->owner->code);
                return $event->isValid;
            },
            ActiveRecord::EVENT_AFTER_UPDATE => function ($event) {
                if (isset($event->changedAttributes['code'])) {
                    $this->updateChildrenCodes();
                }
            },
        ];
    }

    public function getParentsForSelect2() : array
    {
        return ['درج به عنوان گروه'] +
            ArrayHelper::map($this->possibleParents(), 'id', 'codedTitle');
    }

    public function getDepthList()
    {
        return [
            0 => 'گروه',
            1 => 'دسته',
            2 => 'شاخه'
        ];
    }

    public function getDepthTitle()
    {
        $list = $this->getDepthList();
        return isset($list[$this->owner->depth]) ? $list[$this->owner->depth] : '-';
    }

    protected function possibleParents()
    {
        $family = [];
        $owner = $this->owner;
        if (!$owner->isNewRecord) {
            $family[] = $owner->id;
            $children = $owner->children()->select('id')->all();
            foreach ($children as $child) {
                $family[] =  $child->id ;
            }
        }
        return $owner->find()
            ->andWhere(['not in', 'id', $family])
            ->andWhere(['in', 'depth', [0,1]])
            ->all();
    }

    public function getFamilyTreeArray()
    {
        $owner = $this->owner;
        $attributes = [
            'id' => $owner->id,
            'name' => $owner->htmlCodedTitle,
            'code' => $owner->uniqueCode,
            'depth' => $owner->depth
        ];
        if ($owner->children(1)->count() != 0) {
            $children = [];
            foreach ($owner->children(1)->all() as $child) {
                $children[] = $child->getFamilyTreeArray();
            }
        } elseif ($owner->getTypes()->count() != 0) {
            foreach ($owner->types as $type) {
                $children[] = [
                    'id' => $type->id,
                    'name' => $type->htmlCodedTitle,
                    'code' => $type->uniqueCode,
                    'depth' => 3
                ];
            }
        }
        if (!empty($children)) {
            $attributes['children'] = $children;
        }
        return $attributes;
    }

    public function updateChildrenCodes()
    {
        if ($this->owner->children(1)->count() != 0) {
            foreach ($this->owner->children(1)->all() as $child) {
                $child->updateChildrenCodes();
            }
        } elseif ($this->owner->getTypes()->count() != 0) {
            foreach ($this->owner->types as $type) {
                $type->setUniqueCode();
                $type->save(false);
            }
        }
    }
}
