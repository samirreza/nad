<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\Device;

class DeviceDocument extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const LOOKUP_DOCUMENT_FORMAT = 'nad.device.DeviceDocument.docFormat';
    const LOOKUP_DOCUMENT_NAME = 'nad.device.DeviceDocument.docName';

    public static function tableName()
    {
        return 'nad_eng_device_document';
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'core\behaviors\TimestampBehavior',
                [
                    'class' => FileBehavior::className(),
                    'customModelClassName' => static::CONSUMER_CODE,
                    'groups' => [
                        'file' => [
                            'type' => FileBehavior::TYPE_FILE,
                            'rules' => [
                                'extensions' => ['png', 'jpg', 'jpeg', 'pdf', 'docx', 'doc', 'xlsx'],
                                'maxSize' => 5*1024*1024,
                            ]
                        ],
                    ]
                ]
            ]
        );
    }

    public function rules()
    {
        return [
            [['format', 'title', 'deviceId', 'code'], 'required'],
            [['format', 'title', 'deviceId'], 'integer'],
            [['code'], 'trim'],
            [['code'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 1, 'min' => 1],
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
            'code' => 'شمارنده',
            'title' => 'نام مدرک',
            'uniqueCode' => 'شناسه مدرک',
            'format' => 'نوع مدرک',
            'deviceId' => 'شناسه تجهیز',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'deviceId']);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        // dd($this->deviceId);
        // if ($insert) {
        //     $this->consumer = static::CONSUMER_CODE;
        // }
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->device->uniqueCode . '.D.' . $this->code;
    }

    public function getUniqueCode() : string
    {
        return isset($this->uniqueCode)?$this->uniqueCode:'';
    }
}
