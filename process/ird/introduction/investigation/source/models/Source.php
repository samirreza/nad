<?php

namespace nad\process\ird\introduction\investigation\source\models;

use nad\process\ird\introduction\investigation\proposal\models\Proposal;
use nad\process\ird\introduction\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = 'IN';

    public $moduleId = 'introduction';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/introduction/investigation/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
