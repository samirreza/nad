<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use yii\helpers\ArrayHelper;
use nad\common\code\CodableTrait;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\DevicePart;

class PartInstance extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_eng_device_part_instance';
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'core\behaviors\TimestampBehavior',
            ]
        );
    }

    public function rules()
    {
        return [
            [['partId', 'code'], 'required'],
            [['code', 'deviceUniqueCode'], 'trim'],
            [['code', 'deviceUniqueCode'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 1, 'min' => 1],
            [['partId'], 'integer'],
            [['code', 'deviceUniqueCode'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'partId'],
                'message' => 'این شناسه پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شناسه',
            'uniqueCode' => 'شناسه یکتا',
            'deviceUniqueCode' => 'شناسه تجهیزی که قطعه روی آن نصب شده',
            'partId' => 'قطعه',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getPart()
    {
        return $this->hasOne(DevicePart::className(), ['id' => 'partId']);
    }

    public function getDocuments()
    {
        return $this->hasMany(PartInstanceDocument::className(), ['instanceId' => 'id']);
    }

    public function beforeValidate()
    {
        $this->code = strtoupper($this->code);
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        // if ($insert) {
        //     $this->consumer = static::CONSUMER_CODE;
        // }
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->part->uniqueCode . '.' . $this->code;
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }
}
