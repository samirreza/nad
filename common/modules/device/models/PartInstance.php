<?php
namespace nad\common\modules\device\models;

use nad\common\code\Codable;
use yii\helpers\ArrayHelper;
use nad\common\code\CodableTrait;
use extensions\i18n\validators\FarsiCharactersValidator;
use extensions\auditTrail\behaviors\AuditTrailBehavior;

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
            [['partId', 'deviceInstanceId', 'code'], 'required'],
            [['code'], 'trim'],
            [['code'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 3, 'min' => 1],
            [['partId', 'deviceInstanceId'], 'integer'],
            [['code'], FarsiCharactersValidator::className()],
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
            'partId' => 'قطعه',
            'deviceInstanceId' => 'شناسه تجهیزی که قطعه روی آن نصب شده',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getPart()
    {
        return $this->hasOne(DevicePart::className(), ['id' => 'partId']);
    }

    public function getDeviceInstance()
    {
        return $this->hasOne(DeviceInstance::className(), ['id' => 'deviceInstanceId']);
    }

    public function getDocuments()
    {
        return $this->hasMany(DevciePartInstanceDocument::className(), ['instanceId' => 'id']);
    }

    public function beforeValidate()
    {
        $this->code = strtoupper($this->code);
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if ($insert) {
            $this->consumer = static::CONSUMER_CODE;
        }
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

    public static function getRelatedDeviceInstances($deviceId){
        $deviceInstances = DeviceInstance::find()
                ->orderBy(['uniqueCode' => SORT_ASC])
                ->andWhere([
                    'deviceId' => $deviceId
                    ])
                ->all();

        return ArrayHelper::map($deviceInstances, 'id', 'uniqueCode');
    }
}
