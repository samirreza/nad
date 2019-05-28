<?php

namespace nad\process\ird\pool\investigation\source\models;

use nad\process\ird\pool\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\source as Basesource;

class source extends Basesource
{
    const CONSUMER_CODE = 'SD';

    public $moduleId = 'pool';

    public function getReferences()
    {
        return Reference::find()
            ->innerJoin(
                'nad_investigation_reference_relation',
                'nad_investigation_reference_relation.referenceId = nad_investigation_reference.id'
            )
            ->andWhere([
                'moduleId' => $this->moduleId,
                'modelClassName' => (new \ReflectionClass($this))
                    ->getShortName(),
                'modelId' => $this->id
            ])
            ->all();
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
