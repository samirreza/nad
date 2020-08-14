<?php

namespace nad\purchase\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use core\behaviors\TimestampBehavior;
use nad\purchase\behaviors\PreventDeleteBehavior;

/**
 *
 * @property int $id
 * @property int $createdBy
 * @property int $updatedBy
 * @property int $createdAt
 * @property int $updatedAt
 * @property string $title
 * @property string $reason
 */
class BaseForm extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                [
                    'class' => TimestampBehavior::class,
                    'createdAtAttribute' => false
                ],
                [
                    'class' => BlameableBehavior::class,
                    'createdByAttribute' => 'createdBy',
                    'updatedByAttribute' => false
                ],
                [
                    'class' => PreventDeleteBehavior::class,
                    'relations' => [
                        [
                            'relationMethod' => 'hasNextForm',
                            'relationName' => 'فرم بعدی'
                        ]
                    ]
                ],
            ]
        );
    }

    public function hasNextForm(){
        return $this->hasOne(FormsLookup::class, ['id' => 'nextFormId']);
    }
}
