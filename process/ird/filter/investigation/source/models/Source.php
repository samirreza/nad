<?php

namespace nad\process\ird\filter\investigation\source\models;

use nad\process\ird\filter\investigation\proposal\models\Proposal;
use nad\process\ird\filter\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = 'SF';

    public $moduleId = 'filter';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/filter/investigation/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
