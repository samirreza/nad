<?php
namespace modules\nad\material\modules\type\models;

use yii\helpers\ArrayHelper;
use core\behaviors\NestedSetsBehavior;
use core\behaviors\PreventDeleteBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;

class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_material_type_category';
    }

    public function behaviors()
    {
        return [
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'children',
                        'relationName' => 'زیر گروه'
                    ],
                    [
                        'relationMethod' => 'getTypes',
                        'relationName' => 'نوع ماده'
                    ]
                ]
            ],
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                'treeAttribute' => 'tree',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title', 'parentId', 'code'], 'required'],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            [['title'], FarsiCharactersValidator::className()],
            ['code', 'string', 'min' => 2, 'max' => 3]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'شناسه',
            'depth' => 'رده',
            'title' => 'عنوان',
            'nestedTitle' => 'عنوان',
            'code' => 'شناسه رده',
            'compositeCode' => 'شناسه یکتا',
            'parentId' => 'رده پدر',
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        $query = parent::find();
        $query->attachBehavior(
            'nestedQuery',
            'creocoder\nestedsets\NestedSetsQueryBehavior'
        );
        return $query->orderBy(['tree' => SORT_DESC,'lft' => SORT_ASC]);
    }

    public function beforeValidate()
    {
        $this->code = strtoupper($this->code);
        return parent::beforeValidate();
    }

    public function getTypes()
    {
        return $this->hasMany(Type::className(), ['categoryId' => 'id']);
    }

    public function getCompositeCode()
    {
        if ($this->parent == null) {
            return $this->code;
        }
        return $this->parent->getCompositeCode().'. '.$this->code;
    }

    public function getParentsForSelect2()
    {
        return ['درج به عنوان گروه'] +
            ArrayHelper::map($this->possibleParents(), 'id', 'codedTitle');
    }

    public function getHtmlCodedTitle()
    {
        return '<span style="display: inline-block">' . $this->title . '</span><small> ['
            . $this->compositeCode . '] </small>';
    }

    public function getCodedTitle()
    {
        return $this->title .  ' - ' . $this->compositeCode;
    }

    public static function getDepthList()
    {
        return [
            0 => 'گروه',
            1 => 'دسته',
            2 => 'شاخه'
        ];
    }

    public function getDepthTitle()
    {
        $list = self::getDepthList();
        return isset($list[$this->depth]) ? $list[$this->depth] : '-';
    }

    public function possibleParents()
    {
        $family=[];
        if (!$this->owner->isNewRecord) {
            $family[] = $this->owner->id;
            $children = $this->owner->children()->select('id')->all();
            foreach ($children as $child) {
                $family[] =  $child->id ;
            }
        }
        return $this->owner->find()
            ->andWhere(['not in', 'id', $family])
            ->andWhere(['in', 'depth', [0,1]])
            ->all();
    }

    public function getFamilyTreeArray()
    {
        $attributes = [
            'id' => $this->id,
            'name' => $this->htmlCodedTitle,
            'code' => $this->compositeCode,
            'depth' => $this->depth
        ];
        if ($this->children(1)->count() != 0) {
            $children = [];
            foreach ($this->children(1)->all() as $child) {
                $children[] = $child->getFamilyTreeArray();
            }
        } elseif ($this->getTypes()->count() != 0) {
            foreach ($this->types as $type) {
                $children[] = [
                    'id' => $type->id,
                    'name' => $type->htmlCodedTitle,
                    'code' => $type->compositeCode,
                    'depth' => 3
                ];
            }
        }
        if (!empty($children)) {
            $attributes['children'] = $children;
        }
        return $attributes;
    }
}
