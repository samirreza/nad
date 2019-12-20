<?php
namespace nad\common\modules\device\models;

use nad\common\helpers\Lookup as BaseLookup;
use yii\helpers\ArrayHelper;
use extensions\i18n\validators\FarsiCharactersValidator;

class DocNameLookup extends BaseLookup
{
    public const TYPE_PREFIX = 'nad.device.';
    public const TYPE_POSTFIX = '.docName';

    public const TYPE_DEVICE_CATEGORY = self::TYPE_PREFIX . 'categoryDocument' . self::TYPE_POSTFIX;
    public const TYPE_DEVICE = self::TYPE_PREFIX . 'deviceDocument' . self::TYPE_POSTFIX;
    public const TYPE_DEVICE_INSTANCE = self::TYPE_PREFIX . 'deviceInstanceDocument' . self::TYPE_POSTFIX;
    public const TYPE_DEVICE_PART = self::TYPE_PREFIX . 'devicePartDocument' . self::TYPE_POSTFIX;
    public const TYPE_DEVICE_PART_INSTANCE = self::TYPE_PREFIX . 'devicePartInstanceDocument' . self::TYPE_POSTFIX;

    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name', 'type', 'extra'], 'trim'],
            [['name', 'type', 'extra'], 'string', 'max' => 255],
            [['name', 'type', 'extra'], FarsiCharactersValidator::className()],
            [
                'name',
                'unique',
                'targetAttribute' => ['name', 'type'],
                'message' => 'این نام پیش تر ثبت شده است.'
            ],
            [
                'extra',
                'unique',
                'targetAttribute' => ['extra', 'type'],
                'message' => 'این کد پیش تر ثبت شده است.'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'نام مدرک',
            'type' => 'قسمت مرتبط',
            'extra' => 'کد'
        ];
    }

    public function beforeValidate()
    {
        // a simple way to generate incremental unique numbers by using unix timestamp
        $this->code = time();
        $this->position = $this->code;
        return parent::beforeValidate();
    }

    public static function getTypes(){
        return [
            self::TYPE_DEVICE_CATEGORY => 'مدارک رده',
            self::TYPE_DEVICE => 'مدارک نوع دستگاه',
            self::TYPE_DEVICE_INSTANCE => 'مدارک دستگاه',
            self::TYPE_DEVICE_PART => 'مدارک نوع قطعه',
            self::TYPE_DEVICE_PART_INSTANCE => 'مدارک قطعه',
        ];
    }

    public static function find()
    {
        return parent::find()->andWhere(['and', ['like', 'type', self::TYPE_PREFIX . '%', false], ['like', 'type', '%' . self::TYPE_POSTFIX, false]]);
    }
}
