<?php

namespace nad\process\materials\antimicrobial\investigation\source\models;

use nad\process\materials\antimicrobial\investigation\proposal\models\Proposal;
use nad\process\materials\antimicrobial\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\SourceArchived as BaseSourceArchived;

class SourceArchived extends BaseSourceArchived
{
    const CONSUMER_CODE = Source::CONSUMER_CODE;

    public $moduleId = 'antimicrobial';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/antimicrobial/investigation/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
