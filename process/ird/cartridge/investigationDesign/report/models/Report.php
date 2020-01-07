<?php

namespace nad\process\ird\cartridge\investigationDesign\report\models;

use nad\process\ird\cartridge\investigationDesign\report\models\Report;
use nad\process\ird\cartridge\investigationDesign\reference\models\Reference;
use nad\common\modules\investigation\report\models\Report as BaseReport;

class Report extends BaseReport
{
    const CONSUMER_CODE = Report::class;

    public $moduleId = 'cartridge';
    public $referenceClassName = Reference::class;

    // public function getProposal()
    // {
    //     return $this->hasOne(Proposal::class, ['id' => 'proposalId']);
    // }

    public function getBaseViewRoute()
    {
        return '/cartridge/investigationDesign/report/manage/view';
    }

    public static function find()
    {
        return parent::find()->andWhere(['nad_investigation_report.consumer' => self::CONSUMER_CODE]);
    }
}
