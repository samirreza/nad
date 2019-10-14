<?php

namespace nad\process\materials\alkalineWasher\investigation\proposal\models;

use nad\process\materials\alkalineWasher\investigation\report\models\Report;
use nad\process\materials\alkalineWasher\investigation\source\models\Source;
use nad\process\materials\alkalineWasher\investigation\source\models\SourceArchived;
use nad\process\materials\alkalineWasher\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = Proposal::class;

    public $moduleId = 'alkalineWasher';
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
        return '/alkalineWasher/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
