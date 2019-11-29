<?php
namespace nad\common\modules\site\models;

use nad\common\code\Codable;
use nad\common\code\CodableTrait;
use extensions\file\behaviors\FileBehavior;
use extensions\i18n\validators\FarsiCharactersValidator;
use nad\common\modules\site\models\Site;

class Document extends \yii\db\ActiveRecord implements Codable
{
    use CodableTrait;

    const LOOKUP_DOCUMENT_TYPE = 'nad.site.document.Type';

    public static function tableName()
    {
        return 'nad_eng_site_document';
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
            [['type', 'siteId'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'uniqueCode' => 'شناسه مدرک',
            'type' => 'نوع مدرک',
            'siteId' => 'شناسه مکان',
            'createdAt' => 'تاریخ درج',
            'updatedAt' => 'آخرین بروزرسانی'
        ];
    }

    public function getSite()
    {
        return $this->hasOne(Site::className(), ['id' => 'siteId']);
    }

    public function beforeValidate()
    {
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        // dd($this->siteId);
        if ($insert) {
            $this->consumer = static::CONSUMER_CODE;
        }
        $this->setUniqueCode();
        return parent::beforeSave($insert);
    }

    public function setUniqueCode()
    {
        $this->uniqueCode = $this->site->uniqueCode . '.' . $this->type;
    }

    public function getUniqueCode() : string
    {
        return isset($this->uniqueCode)?$this->uniqueCode:'';
    }
}
