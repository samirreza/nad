<?php

namespace nad\process\ird\pool\investigation\source\models;

use nad\process\ird\pool\investigation\proposal\models\Proposal;
use nad\process\ird\pool\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = 'SD';

    public $moduleId = 'pool';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
