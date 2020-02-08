<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use yii\helpers\ArrayHelper;
use nad\common\code\CodableTrait;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\device\models\DeviceDocument;
use nad\common\modules\device\models\Device;
use nad\common\modules\device\models\PartInstance;
use nad\common\modules\device\models\Category;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

class DevicePart extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const LOOKUP_GROUP_TYPE = 'nad.device.devicePart.groupType';

    public static function tableName()
    {
        return 'nad_eng_device_part';
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
            ]
        );
    }

    public function rules()
    {
        return [
            [['deviceId', 'code', 'title'], 'required'],
            [['code', 'title'], 'trim'],
            [['code', 'title'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 3, 'min' => 1],
            [['deviceId', 'group'], 'integer'],
            [['code', 'title'], FarsiCharactersValidator::className()],
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
            'code' => 'شماره قطعه',
            'uniqueCode' => 'شناسه یکتا',
            'instances' => 'تعداد',
            'title' => 'عنوان',
            'group' => 'طبقه بندی قطعه',
            'deviceId' => 'دستگاه',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getDevice()
    {
        return $this->hasOne(Device::className(), ['id' => 'deviceId']);
    }

    public function getInstances()
    {
        return $this->hasMany(PartInstance::className(), ['partId' => 'id']);
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
        $this->uniqueCode = $this->device->uniqueCode . '.S.' . $this->code;
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public static function getAllInstances(){
        $instances = PartInstance::find()
                ->orderBy(['code' => SORT_ASC])
                // ->andWhere([
                //     'depth' => 2
                //     ])
                ->all();

        return ArrayHelper::map($instances, 'id', 'code');
    }
}
