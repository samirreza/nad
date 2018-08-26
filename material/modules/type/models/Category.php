<?php
namespace modules\nad\material\modules\type\models;

use yii\helpers\ArrayHelper;
use core\behaviors\NestedSetsBehavior;
use core\behaviors\PreventDeleteBehavior;
use extensions\file\behaviors\FileBehavior;
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
                        'relationName' => 'زیر دسته'
                    ],
                    [
                        'relationMethod' => 'getMaterialTypes',
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
            'title' => 'عنوان',
            'nestedTitle' => 'عنوان',
            'code' => 'شناسه گروه',
            'compositeCode' => 'شناسه یکتا',
            'parentId' => 'گروه پدر',
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

    public function getMaterialTypes()
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
        return ['آیتم سطح نخست است'] +
            ArrayHelper::map($this->possibleParents(), 'id', 'nestedTitle');
    }

    public function getCodedTitle()
    {
        return $this->compositeCode .  ' - ' . $this->title;
    }
}
