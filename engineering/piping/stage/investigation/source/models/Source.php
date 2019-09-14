<?php

namespace nad\engineering\piping\stage\investigation\source\models;

use nad\engineering\piping\stage\investigation\proposal\models\Proposal;
use nad\engineering\piping\stage\investigation\reference\models\Reference;
use nad\common\modules\investigation\source\models\Source as BaseSource;

class Source extends BaseSource
{
    const CONSUMER_CODE = 'nad\engineering\piping';

    public $moduleId = 'piping';
    public $referenceClassName = Reference::class;

    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['sourceId' => 'id']);
    }

    public function getBaseViewRoute()
    {
        return '/piping/investigation/source/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['consumer' => self::CONSUMER_CODE]);
    }
}
