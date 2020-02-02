<?php

namespace nad\common\modules\engineering\stage\models;

use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use nad\common\code\Codable;
use core\tree\NestedSetsBehavior;
use nad\common\code\CodableTrait;
use nad\common\modules\site\models\Site;
use core\behaviors\PreventDeleteBehavior;
use nad\common\code\CodableCategoryBehavior;
use creocoder\nestedsets\NestedSetsQueryBehavior;
use extensions\auditTrail\behaviors\AuditTrailBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\engineering\location\models\Location;

class Category extends ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_eng_stage_category';
    }

    public function behaviors()
    {
        return [
            [
                'class' => AuditTrailBehavior::class,
                'relations' => []
            ],
            'core\behaviors\TimestampBehavior',
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'children',
                        'relationName' => 'زیر رده'
                    ],
                    [
                        'relationMethod' => 'getTypes',
                        'relationName' => 'نوع تجهیز'
                    ]
                ]
            ],
            'tree' => [
                'class' => NestedSetsBehavior::class,
                'treeAttribute' => 'tree',
            ],
            [
                'class' => CodableCategoryBehavior::class,
                'leafsDepth' => 2
            ]
        ];
    }

    public function rules()
    {
        return [
            [['title', 'parentId', 'code'], 'required'],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            ['title', FarsiCharactersValidator::class],
            ['code', 'string', 'min' => 1, 'max' => 3]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'depth' => 'مرحله',
            'title' => 'عنوان',
            'nestedTitle' => 'عنوان',
            'code' => 'شناسه مرحله',
            'uniqueCode' => 'شناسه',
            'parentId' => 'مرحله پدر',
            'locations' => 'بسته مدارک',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'nestedQuery',
            NestedSetsQueryBehavior::class
        );
        return $query->orderBy(['tree' => SORT_DESC,'lft' => SORT_ASC]);
    }

    public function getUniqueCode() : string
    {
        if ($this->parent == null) {
            return $this->code;
        }
        return $this->code;
    }

    public function getTypes()
    {
        return $this->hasMany(Stage::class, ['categoryId' => 'id']);
    }

    public function getDepthList()
    {
        return [
            0 => 'مرحله 1',
            1 => 'مرحله 2',
            2 => 'مرحله 3',
        ];
    }


    public function getCategoryLocationsAsDropdown(){
        return ArrayHelper::map(
            Location::find()->where(['categoryId' => $this->id])->select(['id', 'title'])->all(),
            'id',
            'title'
        );
    }

    public function getParentTitle(){
        return $this->isRoot() ? 'ندارد' : $this->getParent()->title;
    }

    /**
     * Overrides CodableTrait::getCodedTitle()
     *
     * @return string
     */
    public function getCodedTitle() : string
    {
        return $this->title . ' - ' . $this->code;
    }

    public function getSites()
    {
        return $this->hasMany(Site::class, ['stageCategoryId' => 'id']);
    }

    public function getFamilyTreeArrayForWidget()
    {
        $attributes = [
            'id' => $this->id,
            'name' => $this->htmlCodedTitle,
            'code' => $this->uniqueCode,
            'depth' => $this->depth
        ];
        if ($this->children(1)->count() != 0) {
            $children = [];
            foreach ($this->children(1)->all() as $child) {
                $children[] = $child->getFamilyTreeArrayForWidget();
            }
        } elseif ($this->getSites()->count() != 0) {
            foreach ($this->sites as $site) {
                $children[] = [
                    'id' => $site->id,
                    'name' => $site->deviceTitle,
                    'code' => $site->uniqueCode,
                    'depth' => $this->leafsDepth + 1
                ];
            }
        }
        if (!empty($children)) {
            $attributes['children'] = $children;
        }

        return $attributes;
    }
}
