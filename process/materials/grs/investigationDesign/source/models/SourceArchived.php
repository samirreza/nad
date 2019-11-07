<?php

namespace nad\process\materials\grs\investigationDesign\source\models;

use nad\process\materials\grs\investigationDesign\proposal\models\Proposal;
use nad\process\materials\grs\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\source\models\SourceArchived as BaseSourceArchived;

class SourceArchived extends BaseSourceArchived
{
    const CONSUMER_CODE = Source::CONSUMER_CODE;

    public $moduleId = 'grs';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/grs/investigationDesign/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
