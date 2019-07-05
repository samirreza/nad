<?php

namespace nad\process\ird\cartridge\investigation\proposal\models;

use nad\process\ird\cartridge\investigation\report\models\Report;
use nad\process\ird\cartridge\investigation\source\models\Source;
use nad\process\ird\cartridge\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = 'CF';

    public $moduleId = 'cartridge';
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
        return '/cartridge/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
