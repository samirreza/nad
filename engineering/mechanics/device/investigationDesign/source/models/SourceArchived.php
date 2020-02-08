<?php

namespace nad\engineering\mechanics\device\investigationDesign\source\models;

use nad\engineering\mechanics\device\investigationDesign\proposal\models\Proposal;
use nad\engineering\mechanics\device\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\source\models\SourceArchived as BaseSourceArchived;

class SourceArchived extends BaseSourceArchived
{
    const CONSUMER_CODE = Source::CONSUMER_CODE;

    public $moduleId = 'device';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/device/investigationDesign/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
