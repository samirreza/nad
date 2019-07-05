<?php

namespace nad\process\ird\microbial\investigation\proposal\models;

use nad\process\ird\microbial\investigation\report\models\Report;
use nad\process\ird\microbial\investigation\source\models\Source;
use nad\process\ird\microbial\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = 'MB';

    public $moduleId = 'microbial';
    public $referenceClassName = Reference::class;

    public function getSource()
    {
        return $this->hasOne(Source::class, ['id' => 'sourceId']);
    }

    public function getReport()
    {
        return $this->hasOne(Report::class, ['proposalId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/microbial/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
