<?php

namespace nad\common\modules\investigation\reference\models;

class ReferenceUses extends \yii\db\ActiveRecord
{

    const CODE_SOURCE = 1;
    const CODE_PROPOSAL = 2;
    const CODE_REPORT = 3;
    const CODE_METHOD = 4;

    public $moduleId = 'reference';

    public function rules()
    {
        return [
            [['code', 'referenceId'], 'safe'],
        ];
    }

    public function getReference()
    {
        return $this->hasOne(Reference::class, ['id' => 'referenceId']);
    }

    public static function tableName()
    {
        return 'nad_investigation_reference_uses';
    }

    public static function getCodes()
    {
        return [
            self::CODE_SOURCE => 'منشا',
            self::CODE_PROPOSAL => 'پروپوزال',
            self::CODE_REPORT => 'گزارش',
            self::CODE_METHOD => 'روش',
        ];
    }
}
