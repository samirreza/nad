<?php

namespace nad\process\ird\pool\investigation\proposal\models;

use nad\process\ird\pool\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
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
