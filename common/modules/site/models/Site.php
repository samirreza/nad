<?php
namespace nad\common\modules\site\models;

use nad\common\code\Codable;
use yii\helpers\ArrayHelper;
use nad\common\code\CodableTrait;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\site\models\Document;
use nad\common\modules\engineering\stage\models\Category as StageCategory;

class Site extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const LOOKUP_COORDINATES_TYPE = 'nad.site.site.CoordinatesType';

    public static function tableName()
    {
        return 'nad_eng_site';
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
            [['stageCategoryId', 'code'], 'required'],
            [['description', 'coordinates', 'deviceCode', 'deviceTitle', 'code'], 'trim'],
            [['coordinates', 'deviceCode', 'deviceTitle', 'code'], 'string', 'max' => 255],
            ['code', 'string', 'max' => 10, 'min' => 1],
            [['stageCategoryId', 'coordinatesType'], 'integer'],
            [['description'], 'string'],
            [['description', 'coordinates', 'deviceCode', 'deviceTitle', 'code'], FarsiCharactersValidator::className()],
            [
                'code',
                'unique',
                'targetAttribute' => ['code', 'stageCategoryId'],
                'message' => 'این شناسه پیش تر ثبت شده است.'
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'code' => 'شناسه مکان',
            'uniqueCode' => 'شناسه مکان',
            'deviceTitle' => 'نام تجهیز',
            'deviceCode' => 'شناسه نوع تجهیز',
            'coordinates' => 'مختصات',
            'coordinatesType' => 'نوع مختصات',
            'description' => 'توضیحات',
            'stageCategoryId' => 'رده مرحله',
            'stage.title' => 'عنوان مرحله',
            'stage.familyTreeTitle' => 'عنوان مرحله (شاخه)',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getStage()
    {
        return $this->hasOne(StageCategory::className(), ['id' => 'stageCategoryId']);
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
        $this->uniqueCode = $this->stage->code . '.' . $this->code;
    }

    public function getUniqueCode() : string
    {
        return $this->uniqueCode;
    }

    public static function getAllStages(){
        $stages = StageCategory::find()
        // ->andWhere([
        //     'depth' => 2
        //     ])
        ->all();

        return ArrayHelper::map($stages, 'id', 'title');
    }
}
