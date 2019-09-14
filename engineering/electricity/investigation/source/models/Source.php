<?php

namespace nad\engineering\electricity\investigation\source\models;

use nad\engineering\electricity\investigation\proposal\models\Proposal;
use nad\engineering\electricity\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = 'nad\engineering\electricity';

    public $moduleId = 'electricity';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/electricity/investigation/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
