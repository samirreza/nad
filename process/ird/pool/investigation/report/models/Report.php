<?php

namespace nad\process\ird\pool\investigation\report\models;

use nad\process\ird\pool\investigation\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = 'SD';

    public $moduleId = 'report';

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
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
