<?php

namespace nad\common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use nad\rla\models\RowLevelAccess;

class BaseModel extends ActiveRecord
{
    public static function find()
    {
        if(Yii::$app->user->can('superuser'))
            return parent::find();

        $userId = Yii::$app->user->id;
        $subQuery = (new Query)
                ->select('seq_access_id')
                ->from('row_level_access')
                ->where([
                        'user_id' => $userId
                ])
                ->andWhere(
                    ['or',
                        ['access_type' => RowLevelAccess::ROW_LEVEL_ACCESS_TYPE_PERMANENT],
                        [
                            'and',
                                ['access_type' => RowLevelAccess::ROW_LEVEL_ACCESS_TYPE_TEMPORARY],
                                ['>', 'expire_date', time()]
                        ]
                    ]
                );

        $baseTableName = static::tableName();

        return parent::find()->andWhere(['in', $baseTableName . '.seq_access_id', $subQuery]);
    }
}