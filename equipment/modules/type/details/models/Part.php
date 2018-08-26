<?php
namespace modules\nad\equipment\modules\type\details\models;

use core\behaviors\PreventDeleteBehavior;
use modules\nad\equipment\modules\type\models\Type;
use extensions\i18n\validators\FarsiCharactersValidator;

class Part extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_equipment_type_part';
    }

    public function behaviors()
    {
        return [
            [
                'class' => PreventDeleteBehavior::class,
                'relations' => [
                    [
                        'relationMethod' => 'getModels',
                        'relationName' => 'مدل'
                    ]
                ]
            ]
        ];
    }

    public function rules()
    {
        return [
            [['code'], 'required'],
            [['title', 'code'], 'trim'],
            [['typeId'], 'integer'],
            ['title', 'string', 'max' => 255],
            ['code', 'string', 'min' => 3, 'max' => 3],
            ['code', 'match', 'pattern' => '/^[0-9]{3}$/'],
            [['title'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'typeId'],
                'message' => 'این شماره قطعه پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'code' => 'شماره قطعه',
            'compositeCode' => 'شناسه قطعه',
        ];
    }

    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'typeId']);
    }

    public function getModels()
    {
        return $this->hasMany(Model::className(), ['partId' => 'id']);
    }

    public function getCompositeCode()
    {
        return $this->type->getCompositeCode() . '. S. ' . $this->code;
    }
}
