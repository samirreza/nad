<?php

namespace nad\process\materials\colors\investigationMonitor\proposal\models;

use nad\process\materials\colors\investigationMonitor\report\models\Report;
use nad\process\materials\colors\investigationMonitor\source\models\Source;
use nad\process\materials\colors\investigationMonitor\source\models\SourceArchived;
use nad\process\materials\colors\investigationMonitor\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId = 'colors';
    public $referenceClassName = Reference::class;

    public function getSource()
    {
        // TODO Rewrite with ActiveRecord::exists()
        $source = Source::findOne($this->sourceId);
        if(isset($source))
            return $this->hasOne(Source::class, ['id' => 'sourceId']);
        else
            return $this->hasOne(SourceArchived::class, ['id' => 'sourceId']);

    }

    public function getReport()
    {
        return $this->hasOne(Report::class, ['proposalId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/colors/investigationMonitor/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
