<?php

namespace nad\engineering\construction\investigation\source\models;

use nad\engineering\construction\investigation\proposal\models\Proposal;
use nad\engineering\construction\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = 'nad\engineering\construction';

    public $moduleId = 'construction';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/construction/investigation/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
