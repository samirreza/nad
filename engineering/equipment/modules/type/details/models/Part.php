<?php

namespace nad\engineering\equipment\modules\type\details\models;

use core\behaviors\PreventDeleteBehavior;
use nad\engineering\equipment\modules\type\models\Type;
use extensions\i18n\validators\FarsiCharactersValidator;

class Part extends \nad\engineering\equipment\models\Part
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => PreventDeleteBehavior::class,
                    'relations' => [
                        [
                            'relationMethod' => 'getModels',
                            'relationName' => 'مدل'
                        ]
                    ]
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [['code'], 'required'],
            [['title', 'code'], 'trim'],
            [['typeId', 'kind'], 'integer'],
            ['title', 'string', 'max' => 255],
            ['code', 'string', 'min' => 3, 'max' => 3],
            ['code', 'match', 'pattern' => '/^[0-9]{3}$/'],
            [['title'], FarsiCharactersValidator::class],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'typeId'],
                'message' => 'این شماره قطعه پیش تر ثبت شده است.'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'code' => 'شماره قطعه',
            'kind' => 'نوع قطعه',
            'uniqueCode' => 'شناسه قطعه',
        ];
    }

    public function getType()
    {
        return $this->hasOne(Type::class, ['id' => 'typeId']);
    }

    public function getModels()
    {
        return $this->hasMany(Model::class, ['partId' => 'id']);
    }

    public function beforeSave($insert)
    {
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->type->uniqueCode . '.S.' . $this->code;
    }

    public static function getKindsList()
    {
        return [
            1 => 'استاندارد',
            2 => 'در دسترس',
            3 => 'خود ساخته'
        ];
    }

    public function getKindLabel()
    {
        $list = self::getKindsList();
        return isset($list[$this->kind]) ? $list[$this->kind] : null;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert && isset($changedAttributes['uniqueCode'])) {
            $this->updateModelCodes();
        }
        parent::afterSave($insert, $changedAttributes);
    }

    private function updateModelCodes()
    {
        foreach ($this->models as $model) {
            $model->setUniqueCode();
            $model->save(false);
        }
    }
}
