<?php

namespace nad\common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\db\Query;
use yii\helpers\Url;
use nad\rla\models\RowLevelAccess;

class BaseModel extends ActiveRecord
{
    public static function find()
    {
        if(Yii::$app->user->can('superuser'))
            return parent::find();
        else{
            $userId = Yii::$app->user->id;
            $baseTableName = static::tableName();

            if(strpos(Url::current(), Url::to(['/rla/manage/preview'])) !== false){
                // preview access check
                $subQuery = (new Query)
                    ->select('LEFT(item_type,length(item_type)-6)') // e.g. to convert 'SourceSearch' to 'Search' and so on
                    ->from('row_level_access_preview')
                    ->where([
                        'user_id' => $userId
                    ]);

                return parent::find()->andWhere(['in', $baseTableName . '.`consumer` collate utf8_general_ci ', $subQuery]); // in case any error happens we use collate to cast encoding! wtf!
            }else{
                // row level access check
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

                return parent::find()->andWhere(['in', $baseTableName . '.seq_access_id', $subQuery]);
            }
        }
    }
}