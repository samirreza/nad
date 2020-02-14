<?php

namespace nad\temporary\administrative\unit1\investigation3\source\models;

use nad\temporary\administrative\unit1\investigation3\proposal\models\Proposal;
use nad\temporary\administrative\unit1\investigation3\reference\models\Reference;
use nad\common\modules\investigation\source\models\SourceArchived as BaseSourceArchived;

class SourceArchived extends BaseSourceArchived
{
    const CONSUMER_CODE = Source::CONSUMER_CODE;

    public $moduleId = 'unit1';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/unit1/investigation3/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_source.consumer' => self::CONSUMER_CODE]);
    }
}
