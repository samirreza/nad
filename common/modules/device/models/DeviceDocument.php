<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use nad\common\helpers\Utility;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\DocNameLookup;
use yii\web\ServerErrorHttpException;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

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
                [
                    'class' => AuditTrailBehavior::class,
                    'relations' => []
                ],
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
            [['format', 'title', 'deviceId'], 'required'],
            [['format', 'title', 'deviceId'], 'integer'],
            // [['code'], 'trim'],
            // [['code'], 'string', 'max' => 255],
            // ['code', 'string', 'max' => 1, 'min' => 1],
            // [['code'], FarsiCharactersValidator::className()],
            [
                'title',
                'unique',
                'targetAttribute' => ['title', 'format', 'deviceId'],
                'message' => 'ترکیب نام و نوع مدرک تکراری است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            // 'code' => 'شمارنده',
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
        $this->uniqueCode = $this->device->uniqueCode . '.D' . '.' . $this->getNameCode() . '.' . $this->getFormatCode();
    }

    public function getUniqueCode() : string
    {
        return isset($this->uniqueCode)?$this->uniqueCode:'';
    }

    public function getFormatCode(){
        $codes = [
            1 => 'P',
            2 => 'D',
            3 => 'S',
            4 => 'C',
        ];

        return $codes[$this->format];
    }

    public function getNameCode(){
        $codes = DocNameLookup::extras(DocNameLookup::TYPE_DEVICE);
        $result = $codes[$this->title];

        return $result;
    }
}
