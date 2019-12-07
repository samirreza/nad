<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use yii\helpers\ArrayHelper;
use nad\common\code\CodableTrait;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\DeviceDocument;
use nad\common\modules\device\models\Device;

class DeviceInstance extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public static function tableName()
    {
        return 'nad_eng_device_instance';
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
            [['deviceId', 'code'], 'required'],
            [['code'], 'trim'],
            [['code'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 1, 'min' => 1],
            [['deviceId'], 'integer'],
            [['code'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'deviceId'],
                'message' => 'این شناسه پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شناسه تجهیز',
            'uniqueCode' => 'شناسه یکتا',
            'deviceId' => 'تجهیز',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'deviceId']);
    }

    public function getDocuments()
    {
        return $this->hasMany(InstanceDocument::className(), ['instanceId' => 'id']);
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
        $this->uniqueCode = $this->device->uniqueCode . '.' . $this->code;
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }
}
