<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use nad\common\helpers\Lookup;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\auditTrail\behaviors\AuditTrailBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\Device;

class DocumentGroup extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    public const LOOKUP_TYPE = 'nad.device.documentGroup.type';

    public static function tableName()
    {
        return 'nad_eng_device_document_group';
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
            [['title', 'deviceId'], 'required'],
            [['title', 'code'], 'trim'],
            [['title'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 10, 'min' => 1],
            [['deviceId'], 'integer'],
            [['description'], 'string'],
            [['title'], FarsiCharactersValidator::className()],
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
            'code' => 'شناسه گروه',
            'uniqueCode' => 'شناسه گروه',
            'title' => 'عنوان گروه',
            'description' => 'توضیحات',
            'deviceId' => 'عنوان و شناسه دستگاه',
            'device.title' => 'عنوان دستگاه',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'deviceId']);
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->consumer = static::CONSUMER_CODE;
        }

        $this->code = strtoupper(Lookup::extra('nad.device.documentGroup.type', $this->title));

        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->device->uniqueCode . '.D.' . Lookup::extra(self::LOOKUP_TYPE, $this->title);
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }
}
