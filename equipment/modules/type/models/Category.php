<?php
namespace modules\nad\equipment\modules\type\models;

use extensions\i18n\validators\FarsiCharactersValidator;

class Category extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'nad_equipment_type_category';
    }

    public function rules()
    {
        return [
            [['title', 'code'], 'required'],
            [['code'], 'unique'],
            [['title', 'code'], 'trim'],
            ['title', 'string', 'max' => 255],
            ['code', 'string', 'min' => 3, 'max' => 3],
            [['title'], FarsiCharactersValidator::className()]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => 'عنوان',
            'code' => 'شناسه یکتا'
        ];
    }

    public function beforeValidate()
    {
        $this->code = strtoupper($this->code);
        return parent::beforeValidate();
    }

    public function getCodedTitle()
    {
        return $this->code .  ' - ' . $this->title;
    }
}
