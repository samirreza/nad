<?php
namespace modules\nad\equipment\modules\type\details\models;

use modules\nad\equipment\modules\type\models\Type;
use extensions\i18n\validators\FarsiCharactersValidator;

class Model extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_equipment_type_part_model';
    }

    public function rules()
    {
        return [
            [['code'], 'required'],
            [['title', 'code'], 'trim'],
            [['typeId', 'partId'], 'integer'],
            ['title', 'string', 'max' => 255],
            ['code', 'string', 'min' => 3, 'max' => 3],
            ['code', 'match', 'pattern' => '/^[0-9]{3}$/'],
            [['title'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'partId'],
                'message' => 'این شماره مدل پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'code' => 'شماره مدل',
            'partId' => 'شناسه قطعه',
            'uniqueCode' => 'شناسه مدل',
        ];
    }

    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'typeId']);
    }

    public function getPart()
    {
        return $this->hasOne(Part::className(), ['id' => 'partId']);
    }

    public function beforeSave($insert)
    {
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->part->uniqueCode . '.M.' . $this->code;
    }
}
