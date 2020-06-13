<?php

namespace nad\rla\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "row_level_access".
 *
 * @property int $id
 * @property int $seq_access_id
 * @property int $user_id
 * @property int $access_type
 * @property int $expire_date
 */
class RowLevelAccess extends \yii\db\ActiveRecord
{
    public const ROW_LEVEL_ACCESS_TYPE_PERMANENT = 1;
    public const ROW_LEVEL_ACCESS_TYPE_TEMPORARY = 2;
    public const ROW_LEVEL_ACCESS_EXPIRE_DURATION = 24*60*60; // defaults to one day (in seconds)

    public $userIds;
    public $seqAccessIds;
    public $accessTypes;
    public $expireDates;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'row_level_access';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['seqAccessIds'], 'required'],
            [['userIds', 'accessTypes', 'expireDates'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seq_access_id' => 'Seq Access ID',
            'user_id' => 'User ID',
            'access_type' => 'دسترسی زماندار',
            'expire_date' => 'Expire Date',
            'userIds' => 'لیست کاربران'
        ];
    }

    public static function getItemTypes(){
        return [
            'nad\common\modules\investigation\source\models\SourceSearch' => 'منشا',
            'nad\common\modules\investigation\proposal\models\ProposalSearch' => 'پروپوزال',
            'nad\common\modules\investigation\report\models\ReportSearch' => 'گزارش',
            'nad\common\modules\investigation\method\models\MethodSearch' => 'روش',
            'nad\common\modules\investigation\instruction\models\InstructionSearch' => 'دستورالعمل',
            'nad\common\modules\investigation\subject\models\SubjectSearch' => 'موضوع',
        ];
    }

    public static function getItemTypeTable($type){
        $tmp = [
            'nad\common\modules\investigation\source\models\SourceSearch' => 'nad_investigation_source',
            'nad\common\modules\investigation\proposal\models\ProposalSearch' => 'nad_investigation_proposal',
            'nad\common\modules\investigation\report\models\ReportSearch' => 'nad_investigation_report',
            'nad\common\modules\investigation\method\models\MethodSearch' => 'nad_investigation_method',
            'nad\common\modules\investigation\instruction\models\InstructionSearch' => 'nad_investigation_instruction',
            'nad\common\modules\investigation\subject\models\SubjectSearch' => 'nad_investigation_subject',
        ];
        if(!isset($tmp[$type]))
            throw new \yii\web\HttpException(403, 'Forbidden Request');

        return $tmp[$type];
    }

    /**
     * Generates list of hidden input tags for the given model attribute when the attribute's value is an array.
     *
     * @param Model $model
     * @param string $attribute
     * @param array $options
     * @return string
     */
    public static function activeHiddenInputList($model, $attribute, $options = [])
    {
        $str = '';
        $flattenedList = static::getflatInputNames($attribute, $model->$attribute);
        foreach ($flattenedList as $flattenAttribute) {
            $str.= Html::activeHiddenInput($model, $flattenAttribute, $options);
        }
        return $str;
    }

    /**
     * @param string $name
     * @param array $values
     * @return array
     */
    private static function getflatInputNames($name, array $values)
    {
        $flattened = [];
        foreach ($values as $key => $val) {
            $nameWithKey = $name . '[' . $key . ']';
            if (is_array($val)) {
                $flattened += static::getflatInputNames($nameWithKey, $val);
            } else {
                $flattened[] = $nameWithKey;
            }
        }
        return $flattened;
    }
}
