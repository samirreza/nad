<?php

namespace nad\process\ird\wastewater\investigation\proposal\models;

use nad\process\ird\wastewater\investigation\report\models\Report;
use nad\process\ird\wastewater\investigation\source\models\Source;
use nad\process\ird\wastewater\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = 'WW';

    public $moduleId = 'wastewater';
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
        return '/wastewater/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
