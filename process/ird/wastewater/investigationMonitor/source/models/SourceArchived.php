<?php

namespace nad\process\ird\wastewater\investigationMonitor\source\models;

use nad\process\ird\wastewater\investigationMonitor\proposal\models\Proposal;
use nad\process\ird\wastewater\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\source\models\SourceArchived as BaseSourceArchived;

class SourceArchived extends BaseSourceArchived
{
    const CONSUMER_CODE = Source::CONSUMER_CODE;

    public $moduleId = 'wastewater';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/wastewater/investigationMonitor/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
