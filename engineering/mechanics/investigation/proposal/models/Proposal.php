<?php

namespace nad\engineering\mechanics\investigation\proposal\models;

use nad\engineering\mechanics\investigation\report\models\Report;
use nad\engineering\mechanics\investigation\source\models\Source;
use nad\engineering\mechanics\investigation\reference\models\Reference;
use nad\common\modules\investigation\proposal\models\Proposal as BaseProposal;

class Proposal extends BaseProposal
{
    const CONSUMER_CODE = 'nad\engineering\mechanics';

    public $moduleId = 'mechanics';
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
        return '/mechanics/investigation/proposal/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
