<?php

namespace nad\process\ird\cartridge\investigation\source\models;

use nad\process\ird\cartridge\investigation\proposal\models\Proposal;
use nad\process\ird\cartridge\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = 'CF';

    public $moduleId = 'cartridge';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/cartridge/investigation/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
